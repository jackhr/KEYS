#!/usr/bin/env bash
set -euo pipefail

# Directory where this script lives (config/)
SCRIPT_DIR="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(cd -- "$SCRIPT_DIR/.." && pwd)"

INPUT_DIR="$PROJECT_ROOT/styles"
OUTPUT_DIR="$PROJECT_ROOT/styles/min"

mkdir -p "$OUTPUT_DIR"

shopt -s nullglob
for file in "$INPUT_DIR"/*.css; do
  filename="$(basename "$file" .css)"
  minify "$file" -o "$OUTPUT_DIR/$filename.min.css"
done
