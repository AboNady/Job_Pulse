import './bootstrap';

import Alpine from 'alpinejs';
import chatWidget from './chatWidget';
import companySearch from './company-search';

window.Alpine = Alpine;
window.chatWidget = chatWidget;
window.companySearch = companySearch;

Alpine.start();

import.meta.glob(
    [
        '../images/**'
    ]
);

