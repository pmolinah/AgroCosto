import {
    Modal,
    Chart,
    Timepicker,
    Input,
    Dropdown,
    Ripple,
    Select,
    initTE,
    Collapse,
    Datepicker,
    Tab,
    Datatable,
    Sidenav,
  } from "tw-elements";
  
  initTE({  Datepicker, Collapse, Modal, Dropdown, Ripple, Input, Timepicker, Chart, Select,Datatable,Tab,Sidenav });

import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);
Alpine.start();


