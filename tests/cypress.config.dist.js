const fs = require("fs");
const path = require('path');
const { defineConfig } = require("cypress");
const { MODULES_DIRECTORY } = require('./cypress/support/constants');

module.exports = defineConfig({
  // copy this file as 'cypress.config.js' and 
  // adopt env.username, env.password and e2e.baseUrl if needed
  env: {
    username: "ci-admin", // Joomla admin user
    password: "joomla-17082005", // Joomla admin user password
  },
  e2e: {
    baseUrl: "http://localhost", // Joomla base URL
    //
    supportFile: "cypress/support/index.js",
    specPattern: ["cypress/integration/tests.cy.js"],
    setupNodeEvents(on, config) {

      // reading test steps as entries from directory 'modules-tutorial'
      return new Promise((resolve, reject) => {
        fs.readdir(MODULES_DIRECTORY, (err, files) => {
          if (err) {
            console.error("Error reading directory:", err);
            return reject(err);
          }

          config.env = config.env || {};
          config.env.steps = files;

          resolve(config);
        });
      });
    },
  },
});
