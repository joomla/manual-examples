const fs = require('fs');
const archiver = require('archiver');

/**
 * ZIP folder as file.
 * 
 * @param {*} source directory path
 * @param {*} out file name
 * @returns Promise
 */
const zipFolder = (source, out) => {
  const archive = archiver('zip', { zlib: { level: 9 } });
  const stream = fs.createWriteStream(out);

  return new Promise((resolve, reject) => {
    archive
      .directory(source, false)
      .on('error', err => reject(err))
      .pipe(stream);

    stream.on('close', () => resolve());
    archive.finalize();
  });
};

// eslint-disable-next-line no-unused-vars
module.exports = (on, config) => {
  on('task', {
    zipFolder({ source, out }) {
      return zipFolder(source, out).then(() => ({ success: true })).catch(err => ({ success: false, error: err.message }));
    }
  });
};
