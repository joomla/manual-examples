// All entries from 'module-tutorial' directory are taken as test steps
const MODULES_DIRECTORY = "../module-tutorial";
// Joomla module name - as defined in the to be tested modules
const MODULE_NAME = "Joomla module tutorial";
// Cypress env parameter name to run only one test e.g. npx cypress run --env test=step1_basic_module
const STEP_PARAMETER = "test";
// module zip file name
const ZIP_FILE_NAME = "manual-examples.zip"

module.exports = {
  MODULES_DIRECTORY,
  MODULE_NAME,
  STEP_PARAMETER,
  ZIP_FILE_NAME
};
