<?php
/**
 * Service Booking Modal Component
 * Bulletproof implementation using CSS visibility/opacity transitions.
 */
?>

<!-- Booking Modal Overlay -->
<div id="booking-modal" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(0,0,0,0.6); backdrop-filter:blur(6px); align-items:center; justify-content:center; padding:1rem; opacity:0; transition: opacity 0.3s ease;">
    
    <div id="booking-modal-content" style="background:#fff; width:100%; max-width:720px; border-radius:2rem; box-shadow:0 25px 60px rgba(0,0,0,0.3); overflow:hidden; position:relative; transform:scale(0.9) translateY(20px); opacity:0; transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1), opacity 0.3s ease; max-height:90vh; overflow-y:auto;">
        
        <!-- Close Button -->
        <button id="close-booking-modal" style="position:absolute; top:1.25rem; right:1.25rem; z-index:10; width:2.5rem; height:2.5rem; border-radius:50%; background:#f3f4f6; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:background 0.2s;" onmouseover="this.style.background='#e5e7eb'" onmouseout="this.style.background='#f3f4f6'">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>

        <!-- SUCCESS STATE -->
        <div id="booking-success" style="display:none; padding:3rem; text-align:center; min-height:400px; flex-direction:column; align-items:center; justify-content:center;">
            <div style="width:5rem; height:5rem; background:#34A85322; border-radius:50%; display:flex; align-items:center; justify-content:center; margin:0 auto 1.5rem;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#34A853" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            </div>
            <h3 style="font-size:2rem; font-weight:800; color:#111; margin-bottom:1rem; font-family:'Space Grotesk',sans-serif;">You're all set!</h3>
            <p style="color:#6b7280; font-size:1.1rem; line-height:1.7; max-width:360px; margin:0 auto 2rem;">
                Your consultation request for <strong id="success-service-name" style="color:#4285F4;"></strong> has been received. Our team will reach out within 24 hours.
            </p>
            <button id="booking-success-close" style="padding:0.9rem 2.5rem; background:#111; color:#fff; border:none; border-radius:100px; font-weight:700; font-size:1rem; cursor:pointer; transition:background 0.2s;" onmouseover="this.style.background='#4285F4'" onmouseout="this.style.background='#111'">
                Return to Site
            </button>
        </div>

        <!-- FORM STATE -->
        <div id="booking-form-wrapper" style="display:flex; flex-direction:row; min-height:500px;">
            
            <!-- Left Sidebar -->
            <div style="width:35%; background:linear-gradient(135deg, #4285F408, #4285F415); padding:2.5rem 2rem; display:flex; flex-direction:column; justify-content:space-between; border-right:1px solid #e5e7eb; position:relative; overflow:hidden;">
                <div style="position:absolute; top:0; left:0; right:0; height:4px; background:#4285F4;"></div>
                
                <div>
                    <span style="font-size:10px; font-weight:900; letter-spacing:0.2em; text-transform:uppercase; color:#9ca3af; display:block; margin-bottom:0.75rem;">Premium Service</span>
                    <h2 id="modal-service-title" style="font-size:1.6rem; font-weight:800; color:#111; line-height:1.2; margin-bottom:1rem; font-family:'Space Grotesk',sans-serif;">Consultation</h2>
                    <p id="modal-service-desc" style="font-size:0.85rem; color:#6b7280; line-height:1.7;">Experience elite digital strategy tailored to your enterprise goals.</p>
                </div>

                <div style="margin-top:2rem; display:flex; flex-direction:column; gap:1rem;">
                    <div style="display:flex; align-items:center; gap:0.75rem; font-size:0.8rem; font-weight:700; color:#374151;">
                        <div style="width:1.5rem; height:1.5rem; border-radius:0.4rem; background:#4285F415; display:flex; align-items:center; justify-content:center;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#4285F4" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        30-Min Strategy Call
                    </div>
                    <div style="display:flex; align-items:center; gap:0.75rem; font-size:0.8rem; font-weight:700; color:#374151;">
                        <div style="width:1.5rem; height:1.5rem; border-radius:0.4rem; background:#34A85315; display:flex; align-items:center; justify-content:center;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#34A853" stroke-width="2.5"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        </div>
                        Instant Action Plan
                    </div>
                    <div style="display:flex; align-items:center; gap:0.75rem; font-size:0.8rem; font-weight:700; color:#374151;">
                        <div style="width:1.5rem; height:1.5rem; border-radius:0.4rem; background:#EA433515; display:flex; align-items:center; justify-content:center;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#EA4335" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        NDA Guaranteed
                    </div>
                </div>
            </div>

            <!-- Right Form -->
            <div style="flex:1; padding:2.5rem;">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1.75rem; padding-right: 3rem;">
                    <h3 style="font-size:1.5rem; font-weight:800; color:#111;">Book Session</h3>
                    <div style="display:flex; align-items:center; gap:0.4rem;">
                        <span style="width:8px; height:8px; border-radius:50%; background:#34A853; display:inline-block; animation:pulse 2s infinite;"></span>
                        <span style="font-size:10px; font-weight:700; color:#9ca3af; letter-spacing:0.1em; text-transform:uppercase;">Slots Available</span>
                    </div>
                </div>

                <form id="booking-form" style="display:flex; flex-direction:column; gap:1rem;">
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                        <div style="position:relative;">
                            <svg style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#9ca3af;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <input type="text" name="name" required placeholder="Full Name" style="width:100%; padding:0.85rem 1rem 0.85rem 2.5rem; background:#f9fafb; border:1.5px solid #e5e7eb; border-radius:0.85rem; font-size:0.9rem; font-weight:500; outline:none; box-sizing:border-box; transition:border-color 0.2s;" onfocus="this.style.borderColor='#4285F4'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                        <div style="position:relative;">
                            <svg style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#9ca3af;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 7L2 7"/></svg>
                            <input type="email" name="email" required placeholder="Work Email" style="width:100%; padding:0.85rem 1rem 0.85rem 2.5rem; background:#f9fafb; border:1.5px solid #e5e7eb; border-radius:0.85rem; font-size:0.9rem; font-weight:500; outline:none; box-sizing:border-box; transition:border-color 0.2s;" onfocus="this.style.borderColor='#4285F4'" onblur="this.style.borderColor='#e5e7eb'">
                        </div>
                    </div>

                    <div style="position:relative;">
                        <svg style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:#9ca3af;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                        <input type="date" name="date" required style="width:100%; padding:0.85rem 1rem 0.85rem 2.5rem; background:#f9fafb; border:1.5px solid #e5e7eb; border-radius:0.85rem; font-size:0.9rem; font-weight:500; outline:none; box-sizing:border-box; color:#374151; transition:border-color 0.2s;" onfocus="this.style.borderColor='#4285F4'" onblur="this.style.borderColor='#e5e7eb'">
                    </div>

                    <div style="position:relative;">
                        <svg style="position:absolute; left:14px; top:14px; color:#9ca3af;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                        <textarea name="details" required placeholder="What are your goals for this session?" style="width:100%; padding:0.85rem 1rem 0.85rem 2.5rem; background:#f9fafb; border:1.5px solid #e5e7eb; border-radius:0.85rem; font-size:0.9rem; font-weight:500; outline:none; box-sizing:border-box; height:7rem; resize:none; font-family:inherit; transition:border-color 0.2s;" onfocus="this.style.borderColor='#4285F4'" onblur="this.style.borderColor='#e5e7eb'"></textarea>
                    </div>

                    <input type="hidden" name="service" id="booking-service-input" value="">

                    <button type="submit" id="booking-submit-btn" style="width:100%; padding:1.1rem; background:#111; color:#fff; border:none; border-radius:0.85rem; font-size:1rem; font-weight:800; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:0.6rem; transition:background 0.2s, transform 0.15s;" onmouseover="this.style.background='#4285F4'" onmouseout="this.style.background='#111'">
                        <span id="btn-text">Confirm My Seat</span>
                        <svg id="btn-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                    </button>
                </form>

                <p style="text-align:center; font-size:10px; color:#d1d5db; margin-top:1rem; letter-spacing:0.1em; text-transform:uppercase;">Safe & Secure · Privacy Protected</p>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes pulse { 0%,100%{opacity:1} 50%{opacity:0.4} }
@media (max-width: 640px) {
    #booking-form-wrapper > div:first-child { display: none !important; }
    #booking-form-wrapper > div:last-child { padding: 1.5rem !important; }
    #booking-form-wrapper { flex-direction: column !important; }
}
</style>

<script>
// =====================================================
// Booking Modal - Bulletproof Implementation
// =====================================================

window.openBookingModal = function(title, desc) {
    var modal   = document.getElementById('booking-modal');
    var content = document.getElementById('booking-modal-content');
    var form    = document.getElementById('booking-form');
    var wrapper = document.getElementById('booking-form-wrapper');
    var success = document.getElementById('booking-success');

    if (!modal) { console.error('[Booking] #booking-modal not found'); return; }

    // Populate text
    var titleEl   = document.getElementById('modal-service-title');
    var descEl    = document.getElementById('modal-service-desc');
    var serviceIn = document.getElementById('booking-service-input');
    var successNm = document.getElementById('success-service-name');

    if (titleEl)   titleEl.textContent   = title  || 'Consultation';
    if (descEl)    descEl.textContent    = desc   || 'Experience elite digital strategy tailored to your enterprise goals.';
    if (serviceIn) serviceIn.value       = title  || '';
    if (successNm) successNm.textContent = title  || '';

    // Reset form & states
    if (form) form.reset();
    if (wrapper) { wrapper.style.display = 'flex'; wrapper.style.opacity = '1'; }
    if (success) success.style.display = 'none';

    // Show modal
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';

    // Trigger CSS transition on next frame
    requestAnimationFrame(function() {
        requestAnimationFrame(function() {
            modal.style.opacity = '1';
            content.style.transform = 'scale(1) translateY(0)';
            content.style.opacity = '1';
        });
    });
};

window.closeBookingModal = function() {
    var modal   = document.getElementById('booking-modal');
    var content = document.getElementById('booking-modal-content');
    if (!modal) return;

    modal.style.opacity = '0';
    content.style.transform = 'scale(0.9) translateY(20px)';
    content.style.opacity = '0';

    setTimeout(function() {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 350);
};

document.addEventListener('DOMContentLoaded', function() {
    var closeBtn        = document.getElementById('close-booking-modal');
    var successCloseBtn = document.getElementById('booking-success-close');
    var modal           = document.getElementById('booking-modal');
    var form            = document.getElementById('booking-form');
    var wrapper         = document.getElementById('booking-form-wrapper');
    var success         = document.getElementById('booking-success');
    var submitBtn       = document.getElementById('booking-submit-btn');
    var btnText         = document.getElementById('btn-text');
    var btnIcon         = document.getElementById('btn-icon');

    if (closeBtn)        closeBtn.addEventListener('click', window.closeBookingModal);
    if (successCloseBtn) successCloseBtn.addEventListener('click', window.closeBookingModal);

    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) window.closeBookingModal();
        });
    }

    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            var data = {};
            new FormData(form).forEach(function(v, k) { data[k] = v; });

            // Loading state
            submitBtn.disabled = true;
            btnText.textContent = 'Processing...';
            btnIcon.innerHTML = '<circle cx="12" cy="12" r="10" stroke-dasharray="60" stroke-dashoffset="20" style="animation:spin 1s linear infinite"/>';
            submitBtn.style.background = '#6b7280';

            try {
                var res    = await fetch('api/book_consultation.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                var result = await res.json();

                if (result.success) {
                    if (wrapper) { wrapper.style.display = 'none'; }
                    if (success) {
                        success.style.display = 'flex';
                        success.style.opacity = '1';
                    }
                } else {
                    alert('Submission failed: ' + (result.message || 'Unknown error'));
                }
            } catch (err) {
                console.error('[Booking] Fetch error:', err);
                alert('Something went wrong. Please try again.');
            } finally {
                submitBtn.disabled = false;
                btnText.textContent = 'Confirm My Seat';
                btnIcon.innerHTML = '<line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>';
                btnIcon.setAttribute('fill', 'none');
                btnIcon.setAttribute('stroke', 'currentColor');
                btnIcon.setAttribute('stroke-width', '2.5');
                submitBtn.style.background = '';
            }
        });
    }
});
</script>
