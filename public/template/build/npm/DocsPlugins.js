'use strict'

const Plugins = [
  // AdminLTE Dist
  {
    from: 'template/css/',
    to: 'docs/assets/css/'
  },
  {
    from: 'template/js/',
    to: 'docs/assets/js/'
  },
  // jQuery
  {
    from: 'node_modules/jquery/template/',
    to: 'docs/assets/plugins/jquery/'
  },
  // Popper
  {
    from: 'node_modules/popper.js/template/',
    to: 'docs/assets/plugins/popper/'
  },
  // Bootstrap
  {
    from: 'node_modules/bootstrap/template/js/',
    to: 'docs/assets/plugins/bootstrap/js/'
  },
  // Font Awesome
  {
    from: 'node_modules/@fortawesome/fontawesome-free/css/',
    to: 'docs/assets/plugins/fontawesome-free/css/'
  },
  {
    from: 'node_modules/@fortawesome/fontawesome-free/webfonts/',
    to: 'docs/assets/plugins/fontawesome-free/webfonts/'
  },
  // overlayScrollbars
  {
    from: 'node_modules/overlayscrollbars/js/',
    to: 'docs/assets/plugins/overlayScrollbars/js/'
  },
  {
    from: 'node_modules/overlayscrollbars/css/',
    to: 'docs/assets/plugins/overlayScrollbars/css/'
  }
]

module.exports = Plugins
