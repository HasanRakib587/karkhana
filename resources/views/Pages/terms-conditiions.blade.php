@extends('layouts.app')

@section('title', 'Terms & Conditions')

@section('content')
    <div class="container my-5 pt-5">
        <div class="my-3">
            <h1>Terms & Conditions for <a href="{{ route('home') }}">KarkhanaBD</a></h1>
        </div>
        <hr>
        <div class="mt-2">
            <h5><strong>Effective Date:</strong> January 26, 2026</h5>
            <h5><strong>Last Updated:</strong> January 26, 2026</h5>
        </div>
        <div class="my-3">
            <p>
                Welcome to <a href="{{ route('home') }}">KarkhanaBD</a> (“we”, “our”, “us”, “Website”).
                By accessing or using this Website, you agree to comply with and be bound by these Terms & Conditions. If
                you do not agree, please do not use the Website.
            </p>
            <hr>
        </div>

        {{-- 1 --}}
        <div class="">
            <h2>1. Use of the Website</h2>
            <p>You agree to use this Website only for lawful purposes and in a way that does not:</p>
            <ul>
                <li>Violate any local, national, or international laws</li>
                <li>Infringe on the rights of others</li>
                <li>Disrupt or damage the Website or its functionality</li>
                <li>Attempt unauthorized access to systems or data</li>
            </ul>
            <hr>
        </div>

        {{-- 2 --}}
        <div class="">
            <h2>2. Intellectual Property Rights</h2>
            <p>
                All content on this Website, including text, images, logos, graphics, designs, and layout, is owned by or
                licensed to KarkhanaBD, unless otherwise stated.
            </p>
            <p>You may:</p>
            <ul>
                <li>View and read content for personal use only</li>
            </ul>
            <p>You may not:</p>
            <ul>
                <li>Copy, reproduce, modify, distribute, or republish any content without written permission</li>
            </ul>
            <hr>
        </div>

        {{-- 3 --}}
        <div class="">
            <h2>3. User Submissions</h2>
            <p>If you submit information through contact forms, email, or other methods:</p>
            <ul>
                <li>You confirm the information is accurate and lawful</li>
                <li>You grant us the right to respond or use the information to provide services</li>
                <li>You understand we are not responsible for the content you submit</li>
            </ul>
            <hr>
        </div>

        {{-- 4 --}}
        <div class="">
            <h2>4. Third-Party Links</h2>
            <p>
                Our Website may contain links to third-party websites.
                We do <strong>not</strong> control or endorse these websites and are <strong>not responsible</strong> for
                their content, privacy practices, or
                services.
            </p>
            <p>Visiting third-party sites is at your own risk.</p>
            <hr>
        </div>

        {{-- 5 --}}
        <div class="">
            <h2>5. Limitation of Liability</h2>
            <p>To the fullest extent permitted by law:</p>
            <ul>
                <li>We are not liable for any direct, indirect, or incidental damages resulting from your use of the Website
                </li>
                <li>We do not guarantee the Website will always be available, error-free, or secure</li>
            </ul>
            <hr>
        </div>

        {{-- 6 --}}
        <div class="">
            <h2>6. Disclaimer</h2>
            <p>
                All information on this Website is provided “as is” and “as available.”
                We make no warranties regarding accuracy, reliability, or completeness.
            </p>
            <hr>
        </div>

        {{-- 7 --}}
        <div class="">
            <h2>7. Termination</h2>
            <p>
                We reserve the right to suspend or terminate access to the Website at any time without notice if these Terms
                are violated.
            </p>
            <hr>
        </div>

        {{-- 8 --}}
        <div class="">
            <h2>8. Changes to These Terms</h2>
            <p>
                We may update these Terms & Conditions at any time.
                Continued use of the Website after changes means you accept the revised Terms.
            </p>
            <hr>
        </div>

        {{-- 9 --}}
        <div class="">
            <h2>9. Governing Law</h2>
            <p>
                These Terms are governed by the laws of <strong>Bangladesh</strong>, without regard to conflict of law
                principles.
            </p>
        </div>

        {{-- 10 --}}
        <div class="">
            <h2>10. Contact Information</h2>
            <p>For questions about these Terms:</p>
            <p>Email: <a href="{{ route('contact.page') }}">Visit Contact Page</a></p>
            <p>Website: <a href="{{ route('home') }}">karkhanabd</a></p>
            <hr>
            <hr>
        </div>

        <div class="my-3">
            <h1>Cookie Policy for <a href="{{ route('home') }}">KarkhanaBD</a></h1>
        </div>
        <div class="mt-2">
            <h5><strong>Effective Date:</strong> January 26, 2026</h5>
            <h5><strong>Last Updated:</strong> January 26, 2026</h5>
        </div>
        <p>
            This Cookie Policy explains how <a href="{{ route('home') }}">KarkhanaBD</a> uses cookies and similar
            technologies.
        </p>
        <hr>

        {{-- 1 --}}
        <div class="">
            <h2>1. What Are Cookies?</h2>
            <p>Cookies are small text files stored on your device when you visit a website.
                They help improve user experience by remembering preferences and understanding how visitors use the site.
            </p>
            <hr>
        </div>

        {{-- 2 --}}
        <div class="">
            <h2>2. How We Use Cookies</h2>
            <p>We use cookies to:</p>
            <ul>
                <li>Improve website performance and speed</li>
                <li>Understand visitor behavior and traffic</li>
                <li>Remember user preferences</li>
                <li>Enhance functionality and user experience</li>
            </ul>
            <hr>
        </div>

        {{-- 3 --}}
        <div class="">
            <h2>3. Types of Cookies We Use</h2>
            <div class="">
                <h3>a) Essential Cookies</h3>
                <p>Required for basic website functionality.</p>
                <p>Without these cookies, some parts of the site may not work properly.</p>
            </div>
            <div class="">
                <h3>b) Analytics Cookies</h3>
                <p>Help us understand how visitors interact with the Website (e.g., pages visited, time spent).</p>
                <p>This data is anonymous and used only for improvement purposes.</p>
            </div>
            <div class="">
                <h3>c) Functional Cookies</h3>
                <p>Remember your preferences to provide a smoother experience.</p>
                <p>We also use to handle shopping cart and cart items</p>
            </div>
            <hr>
        </div>

        {{-- 4 --}}
        <div class="">
            <h2>4. Third-Party Cookies</h2>
            <p>
                We may use third-party services (such as analytics or advertising tools) that place cookies on your device.
                These cookies are governed by the privacy policies of the respective third parties.
            </p>
            <hr>
        </div>

        {{-- 5 --}}
        <div class="">
            <h2>5. Managing Cookies</h2>
            <p>You can:</p>
            <ul>
                <li>Accept or decline cookies through your browser settings</li>
                <li>Delete existing cookies from your device</li>
            </ul>
            <p>Note: Disabling cookies may affect some Website features.</p>
            <hr>
        </div>

        {{-- 6 --}}
        <div class="">
            <h2>6. Changes to This Cookie Policy</h2>
            <p>We may update this Cookie Policy from time to time.
                Updates will be posted on this page with a revised effective date.
            </p>
            <hr>
        </div>

        {{-- 7 --}}
        <div class="">
            <h2>7. Contact Us</h2>
            <p>If you have questions about cookies:</p>
            <p>Email: <a href="{{ route('contact.page') }}">Visit Contact Page</a></p>
            <p>Website: <a href="{{ route('home') }}">karkhanabd</a></p>
        </div>
    </div>
@endsection