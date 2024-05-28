const fs = require("fs");
const { MODULES_DIRECTORY } = require("./constants");

/**
 * Read directory 'module-tutorial' entries as test steps.
 *
 * @returns Promise
 */
function readTestSteps() {
  return new Promise((resolve, reject) => {
    fs.readdir(MODULES_DIRECTORY, (err, files) => {
      if (err) {
        console.error("Error reading directory:", err);
        return reject(err);
      }

      // Since we now have step10_update_server, sort the numbers so as not to start with 10
      files = files.sort((a, b) => {
        let numA = parseInt(a.match(/\d+/)[0]);
        let numB = parseInt(b.match(/\d+/)[0]);
        return numA - numB;
      });

      resolve(files);
    });
  });
}

module.exports = { readTestSteps };
