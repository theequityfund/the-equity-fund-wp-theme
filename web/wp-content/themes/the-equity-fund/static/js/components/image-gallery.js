/**
 * Image Gallery
 *
 * Alpine component for the acf/image-gallery block. Wraps around at either end.
 */
export default function imageGallery(count) {
  return {
    current: 0,
    count,

    prev() {
      this.current = (this.current - 1 + this.count) % this.count;
    },

    next() {
      this.current = (this.current + 1) % this.count;
    },

    goTo(index) {
      this.current = index;
    },
  };
}
