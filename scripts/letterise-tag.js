(function() {
  const letterItems = Array.from(document.querySelectorAll('.letterise-tag'));
  letterItems.forEach(function(item) {
    let html = '';
    const letters = item.textContent.split('');
    letters.forEach(function(letter, idx) {
      if(letter === ' ') {
        html += ' ';
      } else {
        html += `<span>${letter}</span>`;
      }
    });
    item.innerHTML = html;
  });
})();
