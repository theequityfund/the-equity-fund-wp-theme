export default function imageGallery(count) {
  return {
    current: 0,
    offset: 0,
    count,

    init() {
      this.$nextTick(() => this.measure());
      this.$refs.track.querySelectorAll('img').forEach(img => {
        if (!img.complete) {img.addEventListener('load', () => this.measure());}
      });
    },

    measure() {
      const slide = this.$refs.track.children[this.current];
      this.offset = slide ? slide.offsetLeft : 0;
    },

    prev() {
      this.goTo((this.current - 1 + this.count) % this.count);
    },

    next() {
      this.goTo((this.current + 1) % this.count);
    },

    goTo(index) {
      this.current = index;
      this.measure();
    },
  };
}
