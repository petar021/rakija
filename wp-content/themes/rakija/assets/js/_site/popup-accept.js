'use strict';
const Accept = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
        const acceptBlock = document.querySelector('.accept-block');
        const center = acceptBlock.querySelector('.accept-block__center');
        const centerSecond = acceptBlock.querySelector('.accept-block__center-second');
        const noBtn = center.querySelector('a:nth-child(1)');
        const yesBtn = center.querySelector('a:nth-child(2)');
        const backBtn = centerSecond.querySelector('a');

        const storageKey = 'ageVerified';
        const thirtyDays = 30 * 24 * 60 * 60 * 1000;

        const verified = localStorage.getItem(storageKey);
        const verifiedTime = localStorage.getItem(`${storageKey}_timestamp`);

        if (!verified || (Date.now() - verifiedTime) > thirtyDays) {
            acceptBlock.style.display = 'block';
        }

        noBtn.addEventListener('click', () => {
            center.classList.add('is-hidden');
            centerSecond.classList.add('is-visible');
        });

        backBtn.addEventListener('click', () => {
            centerSecond.classList.remove('is-visible');
            center.classList.remove('is-hidden');
        });

        yesBtn.addEventListener('click', () => {
            localStorage.setItem(storageKey, 'true');
            localStorage.setItem(`${storageKey}_timestamp`, Date.now().toString());

            // Dodaj fade-out animaciju
            acceptBlock.classList.add('is-fading-out');

            // Ukloni iz DOM-a nakon animacije (npr. 600ms)
            setTimeout(() => {
            acceptBlock.remove();
            }, 600);
        });
	}
};

export default Accept;
