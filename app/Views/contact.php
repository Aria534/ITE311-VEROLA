<?= $this->include('header') ?>

<div class="container mt-5">
    <h1 class="mb-4">Contact Us</h1>

    <div class="row">
        <!-- Contact Info -->
        <div class="col-md-5 mb-4">
            <h4>Get in Touch</h4>
            <p>If you have any questions or inquiries, feel free to contact us.</p>
            <ul class="list-unstyled">
                <li><strong>Email:</strong> example@email.com</li>
                <li><strong>Phone:</strong> +63 912 345 6789</li>
                <li><strong>Address:</strong> General Santos City, Philippines</li>
            </ul>
        </div>

        <!-- Contact Form -->
        <div class="col-md-7">
            <form action="<?= base_url('contact/send') ?>" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Send Message</button>
            </form>
        </div>
    </div>
</div>


