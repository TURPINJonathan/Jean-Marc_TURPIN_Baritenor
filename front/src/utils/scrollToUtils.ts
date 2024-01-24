export function useScrollTo() {
  /**
   * Usage: Scroll to top of the loading page
   */
  function scrollToTopPage() {
    const appElement = document.getElementById('app');

    if (appElement) {
      appElement.scrollTo({
        top: 0,
        behavior: 'smooth',
      });
    } else {
      console.error("Element with id 'app' not found.");
    }
  }

  return { scrollToTopPage }
}