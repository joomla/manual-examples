const helper = require("../support/helper");
const {
  MODULE_NAME,
  MODULES_DIRECTORY,
  STEP_PARAMETER,
} = require("../support/constants");

/**
 * This Cypress test takes all directory entries from `module-tutorial` and
 * tests the installation and function of the Joomla module in the target Joomla.
 */
describe(`Testing '${MODULE_NAME}' from '${MODULES_DIRECTORY}'`, () => {
  const testParameter = Cypress.env(STEP_PARAMETER);
  let testSteps = [];
  if (testParameter) {
    testSteps = [testParameter];
  } else if (Cypress.env("steps") && Array.isArray(Cypress.env("steps"))) {
    testSteps = Cypress.env("steps");
  } else {
    it("should have steps defined in config.env", () => {
      throw new Error("No steps defined in config.env");
    });
  }

  // Steps are all the `module-tutorial` directory entries or from `test` parameter.
  testSteps.forEach((step) => {
    describe(`Testing '${step}'`, () => {
      it("Uninstall extension, if existing", () => {
        helper.uninstallExtensionIfExists(MODULE_NAME);
      });
      it(`Install extension '${MODULE_NAME}'`, () => {
        helper.installAndConfigure(step, MODULE_NAME);
      });
      it("Check module exists in administrator backend", () => {
        helper.checkAdministratorBackend(MODULE_NAME);
      });
      it("Check module outputs on the frontend website", () => {
        helper.checkWebsite(MODULE_NAME, "Hello");
      });
    });
  });
});
