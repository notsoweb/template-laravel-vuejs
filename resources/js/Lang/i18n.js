import { createI18n } from 'vue-i18n';
import es from './es.js';

const messages = {
    es
}
  
const i18n = createI18n({
  locale: 'es',
  fallbackLocale:'es',
  messages
});

export default i18n;