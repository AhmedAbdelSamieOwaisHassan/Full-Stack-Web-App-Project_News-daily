<?php require_once __DIR__.'/inc/header.php'; ?>

<main class="container py-5">
    <div class="row g-4">
        <div class="col-lg-5">
            <div class="form-box h-100">
                <span class="badge bg-primary-subtle text-primary badge-category mb-3" data-i18n="contactBadge">Contact
                    us</span>
                <h1 class="mb-3" data-i18n="contactTitle">Let’s talk</h1>
                <p class="text-secondary" data-i18n="contactText">We’d love to hear from journalists, partners, and
                    readers who want to connect with us.</p>
                <ul class="list-unstyled text-secondary mt-4">
                    <li class="mb-2"><strong data-i18n="emailLabel">Email:</strong> hello@newsdaily.com</li>
                    <li class="mb-2"><strong data-i18n="phoneLabel">Phone:</strong> +1 (555) 014-7821</li>
                    <li><strong data-i18n="officeLabel">Office:</strong> 28 Market Street, New York</li>
                </ul>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="form-box">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" placeholder="Enter your name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Subject</label>
                            <input type="text" class="form-control" placeholder="How can we help?">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" rows="5" placeholder="Write your message here..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-lg" data-i18n="sendMessage">Send
                                message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include __DIR__.'/inc/footer.php'; ?>