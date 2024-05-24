// ***********************************************************
// This example support/index.js is processed and
// loaded automatically before your test files.
//
// This is a great place to put global configuration and
// behavior that modifies Cypress.
//
// You can change the location of this file or turn off
// automatically serving support files with the
// 'supportFile' configuration option.
//
// You can read more here:
// https://on.cypress.io/configuration
// ***********************************************************

import "joomla-cypress";
// only as long as new NPM package is available, see commands.js
import './commands';

// register joomla-cypress additonal commands
before(function () {
  const {
    registerCommands,
  } = require("../../node_modules/joomla-cypress/src/index.js");

  registerCommands();

  Cypress.on("uncaught:exception", (err, runnable) => {
    console.log("err :" + err);
    console.log("runnable :" + runnable);
    return false;
  });
});
