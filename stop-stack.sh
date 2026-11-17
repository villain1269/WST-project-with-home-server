#!/usr/bin/env bash
# ---------------------------------------------------------------
# stop-stack.sh — stop every project screen session, Caddy, and
# MySQL. Idempotent: running it twice is safe.
# ---------------------------------------------------------------
set -u

PROJECTS=(
  "laravel-tfa5"
  "laravel-tfa6"
  "laravel-tfa7"
  "ci4-tsa2"
)

declare -A STATUS
screen_exists() { screen -S "$1" -Q select . >/dev/null 2>&1; }

# ---------- 1. Project screen sessions ----------------------------
for name in "${PROJECTS[@]}"; do
    if screen_exists "$name"; then
        screen -S "$name" -X quit >/dev/null 2>&1
        sleep 1
        if screen_exists "$name"; then
            STATUS[$name]="FAILED (session still alive)"
        else
            STATUS[$name]="stopped"
        fi
    else
        STATUS[$name]="not running"
    fi
done

# ---------- 2. Caddy and MySQL -------------------------------------
for svc in caddy mysql; do
    if sudo systemctl is-active --quiet "$svc"; then
        if sudo systemctl stop "$svc"; then
            STATUS[$svc]="stopped"
        else
            STATUS[$svc]="FAILED (systemctl stop $svc)"
        fi
    else
        STATUS[$svc]="not running"
    fi
done

# ---------- 3. Summary ----------------------------------------------
echo
echo "================ STOP SUMMARY ================"
fail=0
for name in "${PROJECTS[@]}" caddy mysql; do
    printf '  %-14s %s\n' "$name:" "${STATUS[$name]}"
    case "${STATUS[$name]}" in FAILED*) fail=1 ;; esac
done
echo "==============================================="

exit "$fail"
