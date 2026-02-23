#!/bin/bash
# Wrapper shell pour WP-CLI (équivalent du wp.bat pour Windows)

php "$(dirname "$0")/wp-cli.phar" "$@"
