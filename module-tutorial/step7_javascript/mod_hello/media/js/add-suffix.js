if (!window.Joomla) {
  throw new Error('Joomla API was not properly initialised');
}

const { suffix } = Joomla.getOptions('mod_hello.vars');
document.querySelectorAll('.mod_hello').forEach(element => {
  element.innerText += suffix;
});
