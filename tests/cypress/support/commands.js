/*
 * This is a replacement for uninstallExtension() from joomla-cypress
 * as long as new NPM package is available with fix for
 * https://github.com/joomla-projects/joomla-cypress/issues/15
 */

// Uninstall Extension based on a name
Cypress.Commands.add("myUninstallExtension", (extensionName) => {
  cy.log("**** Uninstall an extension ****");
  cy.log("Extension Name: " + extensionName);

  cy.visit("/administrator/index.php?option=com_installer&view=manage");

  cy.searchForItem(extensionName);

  cy.get("#system-message-container .alert").should("not.exist");

  cy.get("#cb0").click();
  // Delete the extension
  cy.get("body").then(($body) => {
    if ($body.find("button.button-delete.btn.btn-danger").length > 0) {
      // Joomla 4: Click on the 'Uninstall' button directly
      cy.clickToolbarButton("delete");
    } else {
      // Joomla >= 5: First open the 'Actions' menu
      cy.get("button.button-status-group.btn.btn-action.dropdown-toggle").click();
      // Second click on the 'Uninstall' button
      cy.get("button.button-delete.dropdown-item").click();
      // Third click on the 'Yes' button to confirm
      cy.get("div.joomla-dialog-container")
        .find("button.button.button-primary.btn.btn-primary[data-button-ok]")
        .click();
    }
  });
  cy.checkForSystemMessage("was successful");

  // Check for warnings during install
  cy.get('joomla-alert[type="warning"]').should("not.exist");

  cy.searchForItem(extensionName);
  cy.get("#installer-manage .alert")
    .contains("No Matching Results")
    .should("exist");

  cy.log("--Uninstall an extension--");
});

/*
 * This is a replacement for installExtensionFromFileUpload() from joomla-cypress
 * as long as new NPM package is available with fix for
 * https://github.com/joomla-projects/joomla-cypress/issues/17
 */

// Installs a Extension in Joomla using the file upload option
Cypress.Commands.add("myInstallExtensionFromFileUpload", (file, type = "Extension") => {
  cy.log("**** Install an extension from file upload ****");
  cy.log("File: " + file);
  cy.log("Type: " + type);

  cy.visit("/administrator/index.php?option=com_installer");

  cy.contains("Upload Package File").click();

  // Wait until the element is available
  cy.get('#legacy-uploader').should('exist').then(($uploader) => {
    if ($uploader) {
      cy.get('#legacy-uploader').invoke('removeClass', 'hidden');
    }
  });

  cy.get("#install_package").attachFile(file);

  cy.checkForSystemMessage("was successful");

  cy.log("--Install an extension from file upload--");
});
