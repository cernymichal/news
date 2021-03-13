<div class="modal micromodal-slide" id="modal-error-message" aria-hidden="true">
  <div class="modal__overlay" tabindex="-1" data-micromodal-close>
    <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-error-message-title">
      <div class="modal__header">
        <h2 class="modal__title" id="modal-error-message-title">
          Chyba
        </h2>
        <button class="modal__close" aria-label="Close modal" data-micromodal-close></button>
      </div>
      <div class="modal__content" id="modal-error-message-content">
        <p>
          <?= $error_message ?>
        </p>
      </div>
      <div class="modal__footer text-center">
        <button class="btn btn-primary m0" data-micromodal-close aria-label="Close this dialog window">Zavřít</button>
      </div>
    </div>
  </div>
</div>