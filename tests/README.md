# Automated Tests for Joomla Developer Manuals

All the Joomla developer manual tutorial samples (see [README.md](../README.md)) can be tested with web browser using Cypress.

## Requirements and Configuration

[Git](https://git-scm.com/), [Cypress](https://www.cypress.io//) and [npm](https://www.npmjs.com/) are required and must be installed. Also needed is a target Joomla installation with language `en-GB` for Joomla admin user.

1. Clone the repository
```
git clone --depth 1 https://github.com/joomla/manual-examples
```
2. Change to the `tests`directory
```
cd manual-examples/tests
```
3. Copy Cypress configuration template `cypress.config.dist.js` to `cypress.config.js`:
```
cp cypress.config.dist.js cypress.config.js
```
4. In the new Cypress configuration file `cypress.config.js` adjust the three values `joomlaBaseURL`, `joomlaAdminUserName` and `joomlaAdminUserPassword` if necessary.
5. Install node modules:
```
npm install
```

## Test Run

Tested are all steps from `module-tutorial` directory by installing the module, publish it, display on all pages and place on the `sidebar-right`. After that it is checked, that the module exists in den administrator backend view and checked in the web site frontend with title and content. Before each test, the module is deleted if it exists already.

Run tests for all `module-tutorial` examples with headless Cypress:
```
npm run cypress:run
```

Run one test only:
```
npm run cypress:run -- --env test=step1_basic_module
```

You can run Cypress with GUI to watch the web browser actions and see all logging output:
```
npm run cypress:open
```

And you can combine it with only testing one step:
```
npm run cypress:open -- --env test=step2_tmp_file
```

After each test, the module is still installed and can also be checked manually.

The tests are based on [joomla-cypress](https://github.com/joomla-projects/joomla-cypress/), in Cypress GUI mode you can see the log messages, e.g.:
```
log **** uninstallExtensionIfExists ****
log **** extensionName: 'Joomla module tutorial'
```

To distinguish the log messages from automated tests form Joomla developer module tutorial are using `****`, e.g.:
```
log **** installAndConfigure ****
log **** directory: 'step1_basic_module'
log **** moduleName: 'Joomla module tutorial'
log **** absolutePath: '/Users/hlu/Desktop/manual-examples/module-tutorial/step1_basic_module'
```
