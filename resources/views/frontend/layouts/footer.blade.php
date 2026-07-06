<footer class="frontend-footer pt-2 mt-3"
    style="background-color: #dfdfdf; border-top: 1px solid #e2e8f0; position: relative; overflow: hidden; box-shadow: 0 -2px 10px rgba(0,0,0,0.02);">
    <div style="display: flex; justify-content: space-between; align-items: stretch; min-height: 70px;">
        <!-- Left Image Section -->
        <div class="footer-left-img" style="flex: 0 0 auto; display: flex; align-items: flex-end;">
            <img src="{{ asset('images/left-footer.png') }}" alt="Left Footer Decoration"
                style="height: 70px; width: auto; object-fit: contain; pointer-events: none;">
        </div>

        <!-- Center Content Section -->
        <div class="footer-center"
            style="flex: 1 1 auto; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 12px 20px;">
            <p style="margin: 0; font-size: 14px; color: #475569; font-weight: 500; letter-spacing: 0.2px;">
                <strong>Copyright &copy; {{ date('Y') }}</strong> <span style="margin: 0 6px; color: #cbd5e1;">|</span>
                <span style="color: #006a4e; font-weight: 600;">Central Integrated Office Automation System
                    (CIOAS)</span>
            </p>
            <p style="margin: 4px 0 0; font-size: 12.5px; color: #64748b;">
                Powered by: <strong><a href="https://www.adventuresoft.com.bd" target="_blank"
                        style="color: #006a4e; text-decoration: none; transition: color 0.2s;"
                        onmouseover="this.style.color='#00523b'" onmouseout="this.style.color='#006a4e'">Adventure
                        Soft</a></strong>
                <span style="margin: 0 8px; color: #cbd5e1;">|</span>
                <span
                    style="background-color: #f1f5f9; padding: 2px 8px; border-radius: 4px; font-weight: 600; font-size: 11px;">Version
                    1.1.2</span>
            </p>
        </div>

        <!-- Right Image Section -->
        <div class="footer-right-img" style="flex: 0 0 auto; display: flex; align-items: flex-end;">
            <img src="{{ asset('images/right-footer.png') }}" alt="Right Footer Decoration"
                style="height: 70px; width: auto; object-fit: contain; pointer-events: none;">
        </div>
    </div>
</footer>

<style>
    /* Responsive styling for footer */
    @media (max-width: 768px) {

        .footer-left-img,
        .footer-right-img {
            display: none !important;
        }

        .footer-center {
            padding: 16px !important;
            text-align: center;
        }
    }
</style>