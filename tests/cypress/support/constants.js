// all entries in this directory taken as test steps
const MODULES_DIRECTORY = "../module-tutorial";
// Joomla module name as defined in the to be tested modules
const MODULE_NAME = "Joomla module tutorial";
// Cypress env parameter name to run only one test e.g. npm run cypress:run --env test=step1_basic_module
const STEP_PARAMETER = "test";

module.exports = {
  MODULES_DIRECTORY,
  MODULE_NAME,
  STEP_PARAMETER
};
