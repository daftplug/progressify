let prefixOverrideList = ['html', 'body'];

module.exports = {
  plugins: [
    require('tailwindcss')({ config: 'tailwind.config.js' }),
    require('postcss-prefix-selector')({
      prefix: '#daftplugAdmin',
      transform: function (prefix, selector, prefixedSelector, filePath, rule) {
        if (prefixOverrideList.includes(selector)) {
          return prefix;
        } else {
          return prefixedSelector;
        }
      },
    }),
    require('autoprefixer'),
    require('cssnano'),
  ],
};
