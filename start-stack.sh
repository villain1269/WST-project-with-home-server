#!/usr/bin/env bash
# ---------------------------------------------------------------
# start-stack.sh — start MySQL, every project (own screen session),
# and Caddy. Idempotent: running it twice will not duplicate anything.
# ---------------------------------------------------------------
set -u

BASE="/home/assistantuser/schoolproj"
LOGS="$BASE/logs"
mkdir -p "$LOGS"

# name|type|folder|port   (type: laravel|codeigniter)
PROJECTS=(
  "laravel-tfa5|laravel|tfa5|8001"
  "laravel-tfa6|laravel|tfa6|8002"
  "laravel-tfa7|laravel|tfa7|8003"
  "ci4-tsa2|codeigniter|tsa2|8004"
)

declare -A STATUS
screen_exists() { screen -S "$1" -Q select . >/dev/null 2>&1; }

# ---------- 1. MySQL ------------------------------------------------
if sudo systemctl is-active --quiet mysql; then
    STATUS[mysql]="already running"
else
    if sudo systemctl start mysql; then
        STATUS[mysql]="started"
    else
        STATUS[mysql]="FAILED (systemctl start mysql)"
    fi
fi
if [ "${STATUS[mysql]}" != "FAILED (systemctl start mysql)" ]; then
    waited=0
    until sudo mysqladmin ping --silent >/dev/null 2>&1; do
        waited=$((waited + 1))
        [ "$waited" -ge 30 ] && { STATUS[mysql]="FAILED (no ping after 30s)"; break; }
        sleep 1
    done
fi

# ---------- 2. Projects (one screen session each) -------------------
for entry in "${PROJECTS[@]}"; do
    IFS='|' read -r name type dir port <<< "$entry"
    path="$BASE/$dir"

    if [ ! -d "$path" ]; then
        STATUS[$name]="MISSING (folder $dir not found)"
        continue
    fi

    if screen_exists "$name"; then
        STATUS[$name]="already running (port $port)"
        continue
    fi

    if [ "$type" = "laravel" ]; then
        if [ ! -f "$path/.env" ]; then
            STATUS[$name]="SKIPPED (.env missing — copy .env.example first)"
            continue
        fi
        cmd="php artisan serve --host=127.0.0.1 --port=$port"
    else
        cmd="php spark serve --host=127.0.0.1 --port=$port"
    fi

    screen -dmS "$name" bash -c "cd '$path' && exec $cmd >> '$LOGS/$name.log' 2>&1"
    sleep 1
    if screen_exists "$name"; then
        STATUS[$name]="started (port $port)"
    else
        STATUS[$name]="FAILED (see $LOGS/$name.log)"
    fi
done

# ---------- 3. Caddy -------------------------------------------------
if sudo systemctl is-active --quiet caddy; then
    STATUS[caddy]="already running"
elif sudo systemctl start caddy; then
    STATUS[caddy]="started"
else
    STATUS[caddy]="FAILED (is /etc/caddy/Caddyfile in place?)"
fi

# ---------- 4. Summary -------------------------------------------------
echo
echo "================ START SUMMARY ================"
fail=0
print_status() {
    printf '  %-14s %s\n' "$1:" "${STATUS[$1]}"
    case "${STATUS[$1]}" in FAILED*|MISSING*) fail=1 ;; esac
}
print_status mysql
for entry in "${PROJECTS[@]}"; do
    IFS='|' read -r name _rest <<< "$entry"
    print_status "$name"
done
print_status caddy
echo "==============================================="

# ---------- 5. Health checks (internal ports) --------------------------
echo "Health checks:"
for entry in "${PROJECTS[@]}"; do
    IFS='|' read -r name type dir port <<< "$entry"
    code=$(curl -s -o /dev/null -w '%{http_code}' --max-time 5 "http://127.0.0.1:$port/" 2>/dev/null || echo 000)
    if [ "$code" -ge 200 ] 2>/dev/null && [ "$code" -lt 400 ] 2>/dev/null; then
        echo "  OK    $name  http://127.0.0.1:$port/  (HTTP $code)"
    else
        echo "  WARN  $name  http://127.0.0.1:$port/  (HTTP $code — app may still be booting, or was skipped)"
    fi
done
code=$(curl -s -o /dev/null -w '%{http_code}' --max-time 5 "http://127.0.0.1:8000/" 2>/dev/null || echo 000)
if [ "$code" = "200" ]; then
    echo "  OK    caddy  http://127.0.0.1:8000/  (HTTP $code — landing page served)"
else
    echo "  WARN  caddy  http://127.0.0.1:8000/  (HTTP $code)"
fi

exit "$fail"
