const fs = require("fs");
const path = require("path");
const { MODULES_DIRECTORY } = require("./constants");

/**
 * Install module, publish it, display on all pages and place on `sidebar-right`.
 *
 * using Cypress test name as module directory name
 *
 * @param {string} dir module variant directory name, e.g. 'step1_basic_module'
 * @param {string} moduleName module name, e.g. 'Joomla Module Tutorial'
 */
function installAndConfigure(dir, moduleName) {
  cy.log("**** installAndConfigure ****");
  cy.log(`**** directory: '${dir}'`);
  cy.log(`**** moduleName: '${moduleName}'`);

  /* create absolute path to the module to be installed from Cypress test file name
   * e.g. from    /Users/hlu/Desktop/manual-examples/cypress/integration/step1_basic_module.cy.js
   * absolutePath /Users/hlu/Desktop/manual-examples/module-tutorial/step1_basic_module
   */
  let absolutePath = path.resolve(
    path.dirname(Cypress.spec.absolute),
    "../../../module-tutorial/",
    dir
  );
  // On Windows seen: '/C:/laragon/www/manual-examples/module-tutorial/step1_basic_module'
  // remove the leading slash if followed by a drive letter
  if (/^\/[A-Za-z]:/.test(absolutePath)) {
    absolutePath = absolutePath.slice(1);
  }
  cy.log(`**** absolutePath: '${absolutePath}'`);

  cy.doAdministratorLogin(Cypress.env("username"), Cypress.env("password"));

  cy.log(`**** absolutePath: '${absolutePath}'`);
  cy.installExtensionFromFolder(absolutePath);
  cy.publishModule(moduleName);
  cy.displayModuleOnAllPages(moduleName);
  cy.setModulePosition(moduleName, "sidebar-right");
  cy.log("---- installAndConfigure ----");
}

/**
 * If the extension is installed then uninstall it.
 *
 * @param {string} extensionName, e.g. 'Joomla Module Tutorial'
 */
function uninstallExtensionIfExists(extensionName) {
  cy.log("**** uninstallExtensionIfExists ****");
  cy.log(`**** extensionName: '${extensionName}'`);

  cy.doAdministratorLogin(Cypress.env("username"), Cypress.env("password"));

  cy.visit("/administrator/index.php?option=com_installer&view=manage");

  cy.searchForItem(extensionName);

  cy.get("#system-message-container .alert").should("not.exist");

  // run without retrying, to check for '#cb0' existence
  cy.then(() => {
    const element = Cypress.$("#cb0");
    if (element.length > 0) {
      cy.log("**** extension to uninstall found");
      // do the uninstall job with joomla-cypress
      cy.uninstallExtension(extensionName);
    } else {
      cy.log("**** no extension to uninstall found");
    }
  });
}

/**
 * Check module is installed in administrator backend.
 *
 * @param {string} moduleName module name, e.g. 'Joomla Module Tutorial'
 */
function checkAdministratorBackend(moduleName) {
  cy.log("**** checkAdministratorBackend ****");
  cy.log(`**** moduleName: '${moduleName}'`);
  cy.doAdministratorLogin(Cypress.env("username"), Cypress.env("password"));
  cy.visit("/administrator/index.php?option=com_modules&view=modules");
  cy.contains("a", moduleName).should("exist");
  cy.log("---- checkAdministratorBackend ----");
}

/**
 * Check module output on frontend website.
 *
 * @param {string} moduleName module name, e.g. 'Joomla Module Tutorial'
 * @param {*} text module text to verify, e.g. 'Hello'
 */
function checkWebsite(moduleName, text) {
  cy.log("**** checkWebsite ****");
  cy.visit("/");
  cy.get("h3.card-header").should("contain.text", moduleName);
  cy.get(".card-body h4").should("contain.text", text);
  cy.log("---- checkWebsite ----");
}

module.exports = { installAndConfigure, uninstallExtensionIfExists, checkAdministratorBackend, checkWebsite };
