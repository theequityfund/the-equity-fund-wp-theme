/**
 * Links
 *
 * Sets rel="noopener noreferrer" and opens external links in a new tab
 */
class Links {
  constructor() {
    this.initLinks();
  }

  initLinks() {
    // Sets target="_blank" rel="noopener noreferrer" on external links
    const allLinks = Array.from(document.querySelectorAll('a'));

    if (allLinks.length > 0) {
      allLinks.forEach(link => {
        if (link.host !== window.location.host) {
          link.setAttribute('rel', 'noopener noreferrer');
          link.setAttribute('target', '_blank');
        }

        // If current link, set aria-current
        if (link.href === window.location.href) {
          link.setAttribute('aria-current', 'page');
        }
      });
    }
  }
}

export default Links;
