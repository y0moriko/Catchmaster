document.addEventListener("DOMContentLoaded", () => {
  const logoutModal = document.getElementById("logoutModal");
  const openBtn = document.getElementById("openLogoutModal");
  const closeBtn = document.getElementById("closeLogoutModal");
  const cancelBtn = document.getElementById("cancelLogout");

  if (openBtn) {
    openBtn.addEventListener("click", e => {
      e.preventDefault();
      logoutModal.style.display = "block";
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener("click", () => {
      logoutModal.style.display = "none";
    });
  }

  if (cancelBtn) {
    cancelBtn.addEventListener("click", () => {
      logoutModal.style.display = "none";
    });
  }

  // Close when clicking outside modal
  window.addEventListener("click", e => {
    if (e.target === logoutModal) {
      logoutModal.style.display = "none";
    }
  });
});
