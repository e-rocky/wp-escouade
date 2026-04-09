<section id="modal-share" class="uk-flex-top uk-modal hex-modal">
  <div class="uk-modal-dialog  uk-margin-auto-vertical">
    <div class="block block-modal__share col-12 bgi bgi--6">
      <div class="block-content">
        <div class="block-header">
          <h2 class="title title-common">
            Partager
          </h2>
          <button class="uk-modal-close uk-icon uk-close uk-modal-close-default" type="button" data-uk-close></button>
        </div>
        <!-- .block-header -->
        <div class="block-body">

          <ul class="actions" data-uk-height-match=".icon">
            <li>
              <a href="mailto:?body={{ get_permalink() }}" class="link email" title="Email" target="_blank" rel="nofollow">
                <i class="icon es-icon-share-email"></i>
                <label class="label">Email</label>
              </a>
            </li>
            <li>
              <a href="https://www.facebook.com/sharer.php?u={{ get_permalink() }}" class="link facebook" title="Facebook" target="_blank" rel="nofollow">
                <i class="icon es-icon-social-facebook"></i>
                <label class="label">Facebook</label>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/intent/tweet?url={{ get_permalink() }}" class="link twitter" title="X" target="_blank" rel="nofollow">
                <i class="icon es-icon-social-x"></i>
                <label class="label">X</label>
              </a>
            </li>
            <li>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ get_permalink() }}" class="link linkedin" title="Linkedin" target="_blank" rel="nofollow">
                <i class="icon es-icon-social-linkedin"></i>
                <label class="label">Linkedin</label>
              </a>
            </li>
          </ul>

          <div class="copy">
            <input name="link" type="text" readonly value="{{ get_permalink() }}">
          </div>

        </div>
        <!-- .block-body -->
      </div>
      <!-- .block-content -->
    </div>
    <!-- .block-modal__share -->
  </div>
</section>
<!-- #modal-share -->