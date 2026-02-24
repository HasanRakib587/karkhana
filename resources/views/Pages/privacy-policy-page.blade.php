@extends('layouts.app')

@section('title', 'Privacy Policy')

@section('content')
    <div class="container my-5 pt-5">
        <div class="my-3">
            <h1>Privacy Policy for <a href="{{ route('home') }}">KarkhanaBD</a></h1>
        </div>
        <hr>
        <div class="mt-2">
            <h5><strong>Effective Date:</strong> January 26, 2026</h5>
            <h5><strong>Last Updated:</strong> January 26, 2026</h5>
        </div>
        <div class="my-3">
            <p>
                <strong>Welcome</strong> to <a href="{{ route('home') }}">KarkhanaBD</a> (“we”, “us”, “our”, “Site”). We
                respect your privacy and are committed to
                protecting your personal information. This Privacy Policy explains how we collect, use, share, and safeguard
                your information when you visit our website.
            </p>
        </div>
        <div class="my-4">
            <p>
                By accessing or using the Site, you agree to the terms of this Privacy Policy. If you do not agree with the
                terms, please do not use the Site.
            </p>
        </div>
        <hr>

        {{-- 1 --}}
        <div class="one">
            <h2>1. Information We Collect</h2>
            <h6>a) Personal Information You Provide</h6>
            <p>
                We may collect personal information that you voluntarily submit, including but not limited to:
            </p>
            <ul>
                <li>Name</li>
                <li>Email address</li>
                <li>Contact number</li>
                <li>Messages or inquiries through forms</li>
                <li>Any other information you send to us voluntarily</li>
            </ul>
            <h6>b) Automatically Collected Information</h6>
            <p>
                When you visit the Site, we automatically collect certain information, such as:
            </p>
            <ul>
                <li>IP address</li>
                <li>Browser type and version</li>
                <li>Device type (mobile, tablet, desktop)</li>
                <li>Operating system</li>
                <li>Pages visited and time spent on the Site</li>
                <li>Referring websites</li>
            </ul>
            <p>
                This information is typically collected through cookies, server logs, and similar technologies.
            </p>
            <hr>
        </div>

        {{-- 2 --}}
        <div class="two">
            <h2>2. How We Use Your Information</h2>
            <p>We use your information for the following purposes:</p>
            <ul>
                <li>To respond to your inquiries, requests, and messages</li>
                <li>To provide, maintain, and improve our services</li>
                <li>To personalize your experience on the Site</li>
                <li>To send updates, newsletters, or marketing communication (only with your consent)</li>
                <li>To analyze website usage and trends</li>
                <li>To protect the security and integrity of the Site</li>
            </ul>
            <hr>
        </div>

        {{-- 3 --}}
        <div class="three">
            <h2>3. Cookies and Tracking Technologies</h2>
            <p>We may use <strong>cookies, web beacons,</strong> and similar technologies to:</p>
            <ul>
                <li>Remember your preferences</li>
                <li>Analyze usage patterns</li>
                <li>Improve functionality</li>
                <li>Serve personalized content</li>
            </ul>
            <p>
                You may choose to disable cookies through your browser settings, but this may affect your ability to use
                some features of the Site.
            </p>
            <hr>
        </div>

        {{-- 4 --}}
        <div class="four">
            <h2>4. Third-Party Services</h2>
            <p>
                We may share information with third-party service providers who help us operate the Site or conduct
                business, such as:
            </p>
            <ul>
                <li>Analytics providers (e.g., Google Analytics)</li>
                <li>Email service providers</li>
                <li>Hosting and infrastructure services</li>
            </ul>
            <p>
                These third parties are <strong>
                    not permitted to use your information for any purpose other than providing services to us.
                </strong>
            </p>
            <p>
                We may also display ads from third-party advertising partners who may collect certain information through
                cookies or similar technologies.
            </p>
            <hr>
        </div>

        {{-- 5 --}}
        <div class="five">
            <h2>5. Data Security</h2>
            <p>
                We take reasonable steps to protect your data using administrative, technical, and physical safeguards.
                However, no method of transmission over the internet or electronic storage is completely secure. We cannot
                guarantee absolute security.
            </p>
            <hr>
        </div>

        {{-- 6 --}}
        <div class="six">
            <h2>6. Children’s Privacy</h2>
            <p>
                Our Site does not knowingly collect personal information from children under the age of 13. If a parent or
                guardian believes their child has provided us with personal information, please contact us so we can delete
                it.
            </p>
            <hr>
        </div>

        {{-- 7 --}}
        <div class="seven">
            <h2>7. Your Rights and Choices</h2>
            <p>Depending on your location, you may have rights to:</p>
            <ul>
                <li>Access the personal data we hold about you</li>
                <li>Request correction or deletion</li>
                <li>Opt out of certain processing or marketing</li>
                <li>Restrict how your personal data is used</li>
            </ul>
            <p>If you wish to exercise any rights, contact us at the details below.</p>
            <hr>
        </div>

        {{-- 8 --}}
        <div class="eight">
            <h2>8. Changes to This Privacy Policy</h2>
            <p>
                We may update this policy from time to time. The Effective Date at the top will reflect the date of the
                latest revision. Your continued use of the Site after changes means you accept the updated policy.
            </p>
            <hr>
        </div>

        {{-- 9 --}}
        <div class="nine">
            <h2>9. Contact Us</h2>
            <p>If you have questions, concerns, or requests about this Privacy Policy, please contact:</p>
            <p>Email: <a href="{{ route('contact.page') }}">Visit Contact Page</a></p>
            <p>Website: <a href="{{ route('home') }}">karkhanabd</a></p>
        </div>
    </div>
@endsection