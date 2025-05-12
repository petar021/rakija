'use strict';
const Wishlist = {

	/*-------------------------------------------------------------------------------
		# Initialize
	-------------------------------------------------------------------------------*/
	init: function () {
        // Pronađi sve YITH dugmiće
        const wishlistButtons = document.querySelectorAll('.yith-wcwl-add-to-wishlist-button');
        
        wishlistButtons.forEach(button => {
            const img = button.querySelector('img');
        
            if (img) {
            // Kreiraj novi div element sa checkbox i SVG sadržajem
            const customHeartHTML = `
                <div>
                <input type="checkbox" id="checkbox" />
                <label for="checkbox">
                    <svg id="heart-svg" viewBox="467 392 58 57" xmlns="http://www.w3.org/2000/svg">
                    <g id="Group" fill="none" fill-rule="evenodd" transform="translate(467 392)">
                        <path d="M28.9955034,43.5021565 C29.8865435,42.7463028 34.7699838,39.4111958 36.0304386,38.4371087 C41.2235681,34.4238265 43.9999258,30.3756814 44.000204,25.32827 C43.8745444,20.7084503 40.2276972,17 35.8181279,17 C33.3361339,17 31.0635318,18.1584833 29.5323721,20.1689268 L28.9999629,20.8679909 L28.4675537,20.1689268 C26.936394,18.1584833 24.6637919,17 22.181798,17 C17.6391714,17 14,20.7006448 14,25.3078158 C14,30.4281078 16.7994653,34.5060727 22.0294634,38.5288772 C23.3319753,39.530742 27.9546492,42.6675894 28.9955034,43.5021565 Z" id="heart" stroke="#fc2779" />
                        <circle id="main-circ" fill="#fc2779" opacity="0" cx="29.5" cy="29.5" r="1.5" />
                        <g class="grp" id="grp7" opacity="0" transform="translate(7 6)">
                        <circle class="cir-a" fill="#9CD8C3" cx="2" cy="6" r="2" />
                        <circle class="cir-b" fill="#8CE8C3" cx="5" cy="2" r="2" />
                        </g>
                        <g class="grp" id="grp6" opacity="0" transform="translate(0 28)">
                        <circle class="cir-a" fill="#CC8EF5" cx="2" cy="7" r="2" />
                        <circle class="cir-b" fill="#91D2FA" cx="3" cy="2" r="2" />
                        </g>
                        <g class="grp" id="grp3" opacity="0" transform="translate(52 28)">
                        <circle class="cir-b" fill="#9CD8C3" cx="2" cy="7" r="2" />
                        <circle class="cir-a" fill="#8CE8C3" cx="4" cy="2" r="2" />
                        </g>
                        <g class="grp" id="grp2" opacity="0" transform="translate(44 6)">
                        <circle class="cir-b" fill="#CC8EF5" cx="5" cy="6" r="2" />
                        <circle class="cir-a" fill="#CC8EF5" cx="2" cy="2" r="2" />
                        </g>
                        <g class="grp" id="grp5" opacity="0" transform="translate(14 50)">
                        <circle class="cir-a" fill="#91D2FA" cx="6" cy="5" r="2" />
                        <circle class="cir-b" fill="#91D2FA" cx="2" cy="2" r="2" />
                        </g>
                        <g class="grp" id="grp4" opacity="0" transform="translate(35 50)">
                        <circle class="cir-a" fill="#F48EA7" cx="6" cy="5" r="2" />
                        <circle class="cir-b" fill="#F48EA7" cx="2" cy="2" r="2" />
                        </g>
                        <g class="grp" id="grp1" opacity="0" transform="translate(24)">
                        <circle class="cir-a" fill="#9FC7FA" cx="2.5" cy="3" r="2" />
                        <circle class="cir-b" fill="#9FC7FA" cx="7.5" cy="2" r="2" />
                        </g>
                    </g>
                    </svg>
                </label>
                </div>
            `;
        
            // Napravi element iz stringa
            const tempDiv = document.createElement('div');
            tempDiv.innerHTML = customHeartHTML;
        
            // Zameni <img> sa novim sadržajem
            img.replaceWith(tempDiv.firstElementChild);
            }
        });        
	}
};

export default Wishlist;
