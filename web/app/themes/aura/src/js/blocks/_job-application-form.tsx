// Tronque un nom de fichier trop long, en gardant l'extension
function truncateFileName(fileName: string, maxLength = 30): string {
  if (fileName.length <= maxLength) return fileName;
  const extIndex = fileName.lastIndexOf('.');
  if (extIndex === -1 || extIndex === 0) {
    return fileName.slice(0, maxLength - 1) + '…';
  }
  const ext = fileName.slice(extIndex);
  const base = fileName.slice(0, maxLength - ext.length - 1);
  return base + '…' + ext;
}
import UIkit from 'uikit';

const $block = document.querySelector('.job-application-form');

declare global {
  interface Window {
    wpAura: WpAura;
  }
}
interface WpAura {
  translations: {
    wpcf7_message: {
      dropzone: {
        success: string;
        error: string;
      };
    };
  };
}

interface AttachmentsResponse {
  success: string;
  data: { file: string; path: string } | null;
  message: string;
}

if ($block) {
  interceptFetch();
  interceptXHR();
}

function interceptFetch() {
  const originalFetch = window.fetch;

  window.fetch = async (...args) => {
    const response = await originalFetch(...args);
    const clone = response.clone();
    const data = await clone.json().catch(() => null);

    if (typeof args[0] === 'string') {
      switch (true) {
        case args[0].includes('/wp-json/contact-form'):
          handleJobApplicationNotification(data);
          break;
        default:
          break;
      }
    }

    return response;
  };
}

function interceptXHR() {
  const originalOpen = XMLHttpRequest.prototype.open;
  XMLHttpRequest.prototype.open = function (method, url: string) {
    this.addEventListener('load', function () {
      // Ici, vous pouvez inspecter la réponse

      let jsonResponse: AttachmentsResponse | null = null;

      try {
        jsonResponse = JSON.parse(this.responseText);
      } catch (e) {
        console.error('Failed to parse JSON response:', e);
      }

      if (jsonResponse) {
        switch (true) {
          case url.includes('admin-ajax'):
            handleJobApplicationAttachmentsNotification(jsonResponse);
            break;
          default:
            break;
        }
      }
    });
    return originalOpen.apply(this, [method, url, true]);
  };
}

function handleJobApplicationNotification(data: { status: string; message: string }) {
  if (data?.status) {
    if (/sent/.test(data.status)) {
      UIkit.notification("<i uk-icon='icon: check'></i><span>" + data.message + '</span>', {
        status: 'success',
        pos: 'bottom-center',
        timeout: 10 * 1000,
      });
      UIkit.modal('.uk-modal.uk-open').hide();
    } else {
      UIkit.notification("<i uk-icon='icon: warning'></i><span>" + data.message + '</span>', {
        status: 'danger',
        pos: 'bottom-center',
      });
    }
  }
}

// Notification handler for job application attachments
function handleJobApplicationAttachmentsNotification(data: AttachmentsResponse) {
  const wpAura: WpAura = window.wpAura;
  if (data?.success) {
    // If the upload is successful, show a success notification with the file name
    if (data?.data?.file) {
      UIkit.notification(
        "<i uk-icon='icon: check'></i><span>" +
          wpAura.translations.wpcf7_message.dropzone.success.replace(
            '%s',
            `<i class="truncate">${truncateFileName(data.data.file)}</i>`
          ) +
          '</span>',
        {
          status: 'success',
          pos: 'bottom-center',
        }
      );
    }
  } else {
    // If the upload fails, show an error notification with the message
    UIkit.notification(
      "<i uk-icon='icon: warning'></i><span>" +
        wpAura.translations.wpcf7_message.dropzone.error +
        '</span>',
      {
        status: 'danger',
        pos: 'bottom-center',
      }
    );
  }
}
