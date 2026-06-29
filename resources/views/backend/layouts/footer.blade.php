<footer class="main-footer"
    style="padding: 12px 20px; background-color: #ffffff; border-top: 1px solid #e5e7eb; font-size: 13px; color: #6b7280; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <strong>Copyright &copy; {{ date('Y') }} <span style="color: #006a4e;">CIOAS</span>.</strong> All rights
        reserved.
    </div>

    <div style="display: flex; align-items: center; gap: 12px;">
        <span>Powered by <a href="https://www.adventuresoft.com.bd" target="_blank"
                style="color: #006a4e; font-weight: 600; text-decoration: none;">Adventure Soft</a></span>
        <span
            style="background-color: #f3f4f6; color: #4b5563; padding: 2px 8px; border-radius: 12px; font-weight: 600; font-size: 11px; border: 1px solid #e5e7eb;">v1.1.2</span>
    </div>
</footer>

<style>
    @media (max-width: 576px) {
        .main-footer {
            flex-direction: column;
            justify-content: center;
            text-align: center;
            gap: 8px;
            padding: 16px !important;
        }
    }
</style>