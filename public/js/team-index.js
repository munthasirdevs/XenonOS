/* Team Index Page JavaScript */
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        // Selected count display
        const selectedCountEl = document.getElementById('selected-count');
        const deleteBtn = document.getElementById('delete-selected');
        const checkboxes = document.querySelectorAll('.team-member-checkbox');

        // Update selected count
        function updateSelectedCount() {
            const selected = document.querySelectorAll('.team-member-checkbox:checked').length;
            if (selectedCountEl) {
                selectedCountEl.textContent = selected;
                selectedCountEl.classList.add('updated');
                setTimeout(() => selectedCountEl.classList.remove('updated'), 200);
            }
            
            // Enable/disable delete button
            if (deleteBtn) {
                deleteBtn.disabled = selected === 0;
            }
        }

        // Add event listeners to checkboxes
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                // Toggle selected class on parent card
                const card = this.closest('.team-member-card, [class*="bg-surface-container rounded-xl"]');
                if (card) {
                    card.classList.toggle('selected', this.checked);
                }
                updateSelectedCount();
            });
        });

        // Delete selected members
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                const selected = document.querySelectorAll('.team-member-checkbox:checked');
                if (selected.length === 0) return;

                if (confirm('Are you sure you want to delete ' + selected.length + ' team member(s)?')) {
                    // Here you would typically make an AJAX call to delete
                    console.log('Deleting members:', Array.from(selected).map(cb => cb.dataset.memberId));
                    
                    // For demo: remove cards from DOM
                    selected.forEach(function(checkbox) {
                        const card = checkbox.closest('[class*="bg-surface-container rounded-xl"]');
                        if (card && !card.querySelector('#add-member-card')) {
                            card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.9)';
                            setTimeout(() => card.remove(), 300);
                        }
                    });

                    updateSelectedCount();
                }
            });
        }

        // Department filter buttons
        const filterBtns = document.querySelectorAll('.department-filter-btn');
        filterBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                // Here you would filter the team cards by department
                console.log('Filtering by:', this.textContent.trim());
            });
        });

        // Add member card click
        const addMemberCard = document.getElementById('add-member-card');
        if (addMemberCard) {
            addMemberCard.addEventListener('click', function() {
                // Here you would open a modal or redirect to add member page
                console.log('Open add member modal/page');
            });
        }

        // View profile buttons
        const viewProfileBtns = document.querySelectorAll('button:contains("View Profile")');
        viewProfileBtns.forEach(function(btn) {
            if (btn.textContent.includes('View Profile')) {
                btn.addEventListener('click', function() {
                    const card = this.closest('[class*="bg-surface-container rounded-xl"]');
                    const memberId = card ? card.querySelector('.team-member-checkbox')?.dataset.memberId : null;
                    console.log('View profile:', memberId);
                });
            }
        });

        // Edit buttons
        const editBtns = document.querySelectorAll('.material-symbols-outlined');
        editBtns.forEach(function(icon) {
            if (icon.textContent.trim() === 'edit') {
                icon.closest('button')?.addEventListener('click', function() {
                    const card = this.closest('[class*="bg-surface-container rounded-xl"]');
                    const memberId = card?.querySelector('.team-member-checkbox')?.dataset.memberId;
                    console.log('Edit member:', memberId);
                });
            }
        });

        // More options buttons
        const moreBtns = document.querySelectorAll('.material-symbols-outlined');
        moreBtns.forEach(function(icon) {
            if (icon.textContent.trim() === 'more_vert') {
                icon.closest('button')?.addEventListener('click', function() {
                    // Here you would show a dropdown menu
                    console.log('Show more options');
                });
            }
        });

        // Download PDF button
        const downloadBtn = document.querySelector('.grid-cols-2 button, .grid-cols-4 > div:last-child');
        if (downloadBtn) {
            downloadBtn.addEventListener('click', function() {
                console.log('Download PDF report');
                // Here you would trigger PDF download
            });
        }
    });

})();
