#!/bin/bash
# Wrapper shell pour Composer (équivalent du composer.bat pour Windows)

php "$(dirname "$0")/composer" "$@"
