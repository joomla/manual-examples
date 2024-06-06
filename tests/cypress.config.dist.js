/* 
 * Copy this file as 'cypress.config.js' and adjust the following three values if necessary.
 */
const joomlaBaseURL = "http://localhost";
const joomlaAdminUserName = "ci-admin";
const joomlaAdminUserPassword = "joomla-17082005";

const { defineConfig } = require("cypress");
const { readTestSteps } = require("./cypress/support/readTestSteps");

module.exports = defineConfig({
  env: {
    username: joomlaAdminUserName,
    password: joomlaAdminUserPassword,
  },
  e2e: {
    baseUrl: joomlaBaseURL,
    //
    supportFile: "cypress/support/index.js",
    specPattern: ["cypress/integration/tests.cy.js"],
    setupNodeEvents(on, config) {
      // Importing tasks from cypress/plugins/index.js
      require("./cypress/plugins")(on, config);

      // Reading test steps as entries from directory 'modules-tutorial'
      return readTestSteps()
        .then((files) => {
          config.env = config.env || {};
          config.env.steps = files;

          return config;
        })
        .catch((err) => {
          console.error("Error in setupNodeEvents:", err);
          throw err;
        });
    },
  },
});
