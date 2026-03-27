import { replaceInFileSync } from 'replace-in-file';
import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const file = path.join(__dirname, '../../style.css');
const content = fs.readFileSync(file, 'utf8');
const versionRegex = /Version:\s*([0-9]+)\.([0-9]+)\.([0-9]+)/;
const match = content.match(versionRegex);

if (!match) {
  console.error('Version not found');
  process.exit(1);
}

const [full, major, minor, patch] = match;

function bumpVersion(type = 'patch') {
  let newMajor = parseInt(major);
  let newMinor = parseInt(minor);
  let newPatch = parseInt(patch);
  if (type === 'major') {
    newMajor += 1;
    newMinor = 0;
    newPatch = 0;
  } else if (type === 'minor') {
    newMinor += 1;
    newPatch = 0;
  } else {
    newPatch += 1;
  }
  return `${newMajor}.${newMinor}.${newPatch}`;
}

const type = process.argv[2] || 'patch';
const newVersion = bumpVersion(type);

replaceInFileSync({
  files: file,
  from: versionRegex,
  to: `Version:            ${newVersion}`,
});

console.log(`Version updated to ${newVersion}`);
