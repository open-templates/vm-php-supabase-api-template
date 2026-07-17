import { COMMON_MANIFEST } from './common.js';

/** @type {[string, string][]} */
export const VM_PHP_SUPABASE_API_MANIFEST = [
  ...COMMON_MANIFEST.filter(([from]) => from !== 'INSTRUCTIONS.md'),
  ['package.json', 'package.json'],
  ['README.md', 'README.md'],
  ['INSTRUCTIONS.md', 'INSTRUCTIONS.md'],
  ['docker-compose.yml', 'docker-compose.yml'],
  ['.env.example', '.env.example'],
];
