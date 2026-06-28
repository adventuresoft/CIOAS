<footer class="main-footer"
    style="padding: 0; background-color: #dfdfdf; border-top: 2px solid #e6f3ef; position: relative; overflow: hidden; min-height: 80px; display: flex; flex-direction: column; justify-content: center; z-index: 1; box-shadow: 0 -4px 10px rgba(0, 106, 78, 0.03);">

    <!-- Left Decorative Image (Absolutely Positioned) -->
    <img src="{{ asset('images/left-footer.png') }}" alt=""
        style="position: absolute; left: 0; bottom: 0; height: 100%; object-fit: contain; pointer-events: none; opacity: 0.95; z-index: -1;">

    <!-- Right Decorative Image (Absolutely Positioned) -->
    <img src="{{ asset('images/right-footer.png') }}" alt=""
        style="position: absolute; right: 0; bottom: 0; height: 100%; object-fit: contain; pointer-events: none; opacity: 0.95; z-index: -1;">

    <!-- Center Content Section -->
    <div style="text-align: center; position: relative; z-index: 10; padding: 10px 80px;">
        <h6
            style="margin: 0 0 6px; font-size: 15px; color: #006a4e; font-weight: 700; letter-spacing: 0.5px; text-transform: uppercase;">
            Central Integrated Office Automation System (CIOAS)
        </h6>
        <div
            style="display: flex; justify-content: center; align-items: center; gap: 12px; font-size: 13px; color: #64748b; font-weight: 500;">
            <span><strong>Copyright &copy; {{ date('Y') }}</strong></span>
            <span style="color: #cbd5e1;">|</span>
            <span>Powered by: <a href="https://www.adventuresoft.com.bd" target="_blank"
                    style="color: #006a4e; font-weight: 700; text-decoration: none; transition: 0.2s; border-bottom: 1px dotted #006a4e; padding-bottom: 1px;"
                    onmouseover="this.style.color='#00523b'" onmouseout="this.style.color='#006a4e'">Adventure
                    Soft</a></span>
            <span style="color: #cbd5e1;">|</span>
            <span
                style="background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; padding: 2px 10px; border-radius: 20px; font-weight: 700; font-size: 11px;">Version
                1.1.2</span>
        </div>
    </div>
</footer>

<style>
    /* Responsive styling for footer */
    @media (max-width: 768px) {
        .main-footer {
            min-height: auto !important;
            padding: 20px 0 !important;
        }

        .main-footer img {
            display: none !important;
        }

        .main-footer>div {
            padding: 0 20px !important;
        }

        .main-footer>div>div {
            flex-direction: column;
            gap: 6px !important;
        }

        .main-footer span[style*="color: #cbd5e1"] {
            display: none;
        }
    }
</style>