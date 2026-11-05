/**
 * Famewoven Brand Showcase Video Controller
 * Handles:
 * 1. Autoplay on scroll into viewport (IntersectionObserver)
 * 2. Unmuted audio playback with browser autoplay policy fallback
 * 3. Interactive sound toggle button with visual feedback
 * 4. Click anywhere on video to redirect to https://x.com/famewoven
 */

(function () {
  window.addEventListener('DOMContentLoaded', function () {
    const video = document.getElementById('brand-showcase-video');
    const wrapper = document.getElementById('brand-video-wrapper');
    const soundBtn = document.getElementById('brand-video-sound-btn');
    const soundText = document.getElementById('sound-text');
    const soundDot = document.getElementById('sound-dot');
    const iconUnmuted = document.getElementById('sound-icon-unmuted');
    const iconMuted = document.getElementById('sound-icon-muted');

    if (!video || !wrapper) return;

    let isVideoInView = false;
    let hasUserInteracted = false;

    // Update sound button UI state
    function updateSoundUI(isUnmuted) {
      if (!soundText || !soundDot || !iconUnmuted || !iconMuted) return;
      if (isUnmuted) {
        soundText.textContent = 'Sound: ON';
        soundDot.classList.remove('bg-[#9AA391]');
        soundDot.classList.add('bg-[#D4F54F]');
        iconUnmuted.classList.remove('hidden');
        iconMuted.classList.add('hidden');
      } else {
        soundText.textContent = 'Sound: Muted';
        soundDot.classList.remove('bg-[#D4F54F]');
        soundDot.classList.add('bg-[#9AA391]');
        iconUnmuted.classList.add('hidden');
        iconMuted.classList.remove('hidden');
      }
    }

    // Play video with audio policy handling
    function playVideo() {
      const promise = video.play();
      if (promise !== undefined) {
        promise.then(function () {
          updateSoundUI(!video.muted);
        }).catch(function () {
          // If unmuted autoplay blocked by browser, fallback to muted autoplay
          if (!video.muted) {
            video.muted = true;
            updateSoundUI(false);
            video.play().catch(function () {});
          }
        });
      }
    }

    // Pause video when scrolled out of view
    function pauseVideo() {
      video.pause();
    }

    // Attempt unmuting with playback
    function tryEnableSound() {
      video.muted = false;
      const promise = video.play();
      if (promise !== undefined) {
        promise.then(function () {
          updateSoundUI(true);
        }).catch(function () {
          video.muted = true;
          updateSoundUI(false);
          video.play().catch(function () {});
        });
      }
    }

    // Unlock audio upon first user gesture anywhere on page
    function handleFirstUserInteraction() {
      if (hasUserInteracted) return;
      hasUserInteracted = true;
      if (isVideoInView && video.muted) {
        tryEnableSound();
      }
      window.removeEventListener('click', handleFirstUserInteraction);
      window.removeEventListener('touchstart', handleFirstUserInteraction);
      window.removeEventListener('keydown', handleFirstUserInteraction);
    }

    window.addEventListener('click', handleFirstUserInteraction, { passive: true });
    window.addEventListener('touchstart', handleFirstUserInteraction, { passive: true });
    window.addEventListener('keydown', handleFirstUserInteraction, { passive: true });

    // Sound toggle button click
    if (soundBtn) {
      soundBtn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation(); // Crucial: Stop propagation so wrapper click doesn't redirect!
        hasUserInteracted = true;

        if (video.muted) {
          video.muted = false;
          video.play().then(function () {
            updateSoundUI(true);
          }).catch(function () {
            video.muted = true;
            updateSoundUI(false);
          });
        } else {
          video.muted = true;
          updateSoundUI(false);
        }
      });
    }

    // Video click redirects to https://x.com/famewoven
    wrapper.addEventListener('click', function (e) {
      if (e.target.closest('#brand-video-sound-btn')) {
        return; // Don't redirect if sound button was clicked
      }
      e.preventDefault();
      window.location.href = 'https://x.com/famewoven';
    });

    // IntersectionObserver to autoplay when scrolling to the video
    const observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          isVideoInView = true;
          if (hasUserInteracted) {
            video.muted = false;
          }
          playVideo();
        } else {
          isVideoInView = false;
          pauseVideo();
        }
      });
    }, {
      threshold: 0.25
    });

    observer.observe(wrapper);
  });
})();
