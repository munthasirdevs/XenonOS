// Billing Index Page JavaScript
document.addEventListener("DOMContentLoaded", function() {
    // Tab switching for Revenue Trends chart
    const tabButtons = document.querySelectorAll('[role="tab"]');
    tabButtons.forEach(button => {
        button.addEventListener("click", function() {
            tabButtons.forEach(btn => {
                btn.setAttribute("aria-selected", "false");
                btn.classList.remove("bg-surface-container-high", "text-primary");
                btn.classList.add("text-on-surface-variant");
            });
            this.setAttribute("aria-selected", "true");
            this.classList.add("bg-surface-container-high", "text-primary");
            this.classList.remove("text-on-surface-variant");
        });
    });
    
    // Chart bar hover effects
    const chartBars = document.querySelectorAll('.transition-all.duration-300');
    chartBars.forEach(bar => {
        bar.addEventListener("mouseenter", function() {
            if (this.tagName === "rect") {
                this.style.opacity = "0.7";
            }
        });
        bar.addEventListener("mouseleave", function() {
            if (this.tagName === "rect") {
                this.style.opacity = "";
            }
        });
    });
});
