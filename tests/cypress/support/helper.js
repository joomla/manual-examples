const path = require("path");
const { ZIP_FILE_NAME } = require("./constants");

/**
 * Install module, publish it, display on all pages and place on `sidebar-right`.
 *
 * Using Cypress test name as module directory name.
 * Upload with ZIP file (and not install from a folder) to have the possibility to test with remote target Joomla.
 *
 * @param {string} dir module variant directory name, e.g. 'step1_basic_module'
 * @param {string} moduleName module name, e.g. 'Joomla Module Tutorial'
 */
function installAndConfigure(dir, moduleName) {
  cy.log("**** installAndConfigure ****");
  cy.log(`**** directory: '${dir}'`);
  cy.log(`**** moduleName: '${moduleName}'`);

  /* Construct the absolute path of the module to be installed from the name of the Cypress test file.
   *   e.g. from    /Users/hlu/Desktop/manual-examples/cypress/integration/step1_basic_module.cy.js
   *   absolutePath /Users/hlu/Desktop/manual-examples/module-tutorial/step1_basic_module
   */
  let absolutePath = path.join(path.dirname(Cypress.spec.absolute), "../../../module-tutorial/", dir);
  cy.log(`**** absolutePath: '${absolutePath}'`);

  // Create ZIP file in the 'fixtures' folder, as attachFile() expects the file there.
  const zipFile = path.join(path.dirname(Cypress.spec.absolute), '../fixtures', ZIP_FILE_NAME);
  cy.log(`**** zipFile: '${zipFile}'`);
  cy.task("zipFolder", { source: absolutePath, out: zipFile }).then(
    (result) => {
      expect(result.success).to.be.true;
    }
  );

  cy.doAdministratorLogin(Cypress.env("username"), Cypress.env("password"));
  cy.installExtensionFromFileUpload(ZIP_FILE_NAME);
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

  // Run without retrying, to check for '#cb0' existence
  cy.then(() => {
    const element = Cypress.$("#cb0");
    if (element.length > 0) {
      cy.log("**** extension to uninstall found");
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

module.exports = {
  installAndConfigure,
  uninstallExtensionIfExists,
  checkAdministratorBackend,
  checkWebsite,
};
