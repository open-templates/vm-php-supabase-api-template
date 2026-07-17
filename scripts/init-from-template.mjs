#!/usr/bin/env node

import { initFromTemplate } from './lib/template-init/index.js';
import { VM_PHP_SUPABASE_API_MANIFEST } from './lib/template-init/manifests/vm-php-supabase-api.js';
import { printHelp } from './lib/template-init/parse-args.js';
import { brandHeader, error as printError } from './lib/template-init/terminal.js';

const args = process.argv.slice(2);
if (args.includes('--help') || args.includes('-h')) {
  brandHeader('vm php supabase api template');
  printHelp('vm-php-supabase-api-template');
  process.exit(0);
}

initFromTemplate({
  manifest: VM_PHP_SUPABASE_API_MANIFEST,
  includePackageName: false,
  includeAuthorStep: true,
  includeBundler: false,
  templateLabel: 'vm php supabase api template',
  authorStep: {
    stepTitle: 'maintainer (Git owner)',
    selectMessage: 'How should we set the package maintainer?',
    acceptLabel: 'Accept detected Git owner',
  },
  scriptsCleanup: 'all',
  extraReplacements: [['paired-repo-name', 'react-supabase-auth-template']],
  nextSteps:
    'cp .env.example .env, configure Supabase keys, then docker compose up -d (see docs/DEPLOYMENT.md)',
}).catch((err) => {
  printError(`Init failed: ${err.message}`);
  process.exit(1);
});
