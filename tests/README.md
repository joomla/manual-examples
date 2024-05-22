# Automated Tests for Joomla Developer Manuals

All the Joomla developer manual tutorial samples (see [README.md](../README.md)) can be tested with web browser using Cypress.

## Requirements and Configuration

[Git](https://git-scm.com/) and [Cypress](https://www.cypress.io//) are required and must be installed.
Also needed is a target Joomla installation.

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
4. Adjust the `baseURL`, `username` and `password` values in the `cypress.config.js` file.
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
