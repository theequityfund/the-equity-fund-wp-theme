import 'lazysizes';
import 'lazysizes/plugins/unveilhooks/ls.unveilhooks';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import { onDocumentReady } from '@src/utils';

// Components
import Links from '@src/components/links';

onDocumentReady(() => {
  new Links();

  window.Alpine = Alpine;
  Alpine.plugin(focus);
  Alpine.start();
});
