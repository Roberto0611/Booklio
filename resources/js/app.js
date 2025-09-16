import './bootstrap';

// Prevent double form submissions and rapid re-clicks on actions
document.addEventListener('DOMContentLoaded', () => {
	// Reset forms when navigating back/forward with bfcache so users can submit again
	window.addEventListener('pageshow', (event) => {
		if (event.persisted) {
			document.querySelectorAll('form[data-submitted="true"]').forEach((form) => {
				form.dataset.submitted = 'false';
				const submitters = form.querySelectorAll('button[type="submit"], input[type="submit"]');
				submitters.forEach((btn) => {
					btn.disabled = false;
					btn.classList.remove('opacity-50', 'cursor-not-allowed');
					if (btn.dataset.originalHtml) {
						btn.innerHTML = btn.dataset.originalHtml;
					}
				});
			});
		}
	});
	// 1) Guard: lock form after first submit
	document.querySelectorAll('form').forEach((form) => {
		form.addEventListener('submit', (e) => {
			if (form.dataset.submitted === 'true') {
				e.preventDefault();
				e.stopPropagation();
				return false;
			}
			form.dataset.submitted = 'true';

			const submitters = form.querySelectorAll('button[type="submit"], input[type="submit"]');
			submitters.forEach((btn) => {
				// Skip if already disabled
				if (btn.disabled) return;

				// Remember original label to optionally restore if needed
				if (!btn.dataset.originalHtml) {
					btn.dataset.originalHtml = btn.innerHTML;
				}

				// Disable and show loading state
				btn.disabled = true;
				btn.classList.add('opacity-50', 'cursor-not-allowed');

				const loadingText = btn.dataset.loadingText || 'Procesando...';
				const showSpinner = btn.dataset.noSpinner === undefined; // allow opting out with data-no-spinner

				if (showSpinner) {
					btn.innerHTML = `
						<svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-current inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true">
							<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
							<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
						</svg>
						<span>${loadingText}</span>
					`;
				} else {
					btn.textContent = loadingText;
				}
			});
		});
	});

	// 2) Generic one-shot click: add data-once to any clickable element (e.g., links triggering POST via JS or routes)
	document.querySelectorAll('[data-once]').forEach((el) => {
		el.addEventListener('click', function (e) {
			if (this.dataset.clicked === 'true') {
				e.preventDefault();
				e.stopPropagation();
				return false;
			}
			this.dataset.clicked = 'true';
			this.classList.add('opacity-50', 'cursor-not-allowed');
			this.setAttribute('aria-disabled', 'true');
		});
	});
});
