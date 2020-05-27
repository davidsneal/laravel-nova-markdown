<template>
  <field-wrapper>
    <div class="w-1/5 px-8 py-6">
      <slot>
        <form-label :for="field.name">
          {{ field.name }}
        </form-label>
      </slot>
    </div>
    <div class="w-4/5 px-8 py-6">
      <div :id="`${field.name}_editor`" class="prosemirror-editor px-0 w-full form-control form-input form-input-bordered" />
      <p v-if="hasError" class="my-2 text-danger">
        {{ firstError }}
      </p>
    </div>
  </field-wrapper>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import Editor from '@toast-ui/editor'
import '@toast-ui/editor/dist/toastui-editor.css'

export default {
    mixins: [
      FormField,
      HandlesValidationErrors,
    ],

    props: [
      'resourceName',
      'resourceId',
      'field',
    ],

    mounted() {
      this.editor = new Editor({
        el: document.querySelector(`#${this.field.name}_editor`),
        customHTMLRenderer: {
          text(node, context) {
            const italic = node.parent.type === 'i';
            return {
              type: 'text',
              content: italic ? `<em>${node.literal}</em>` : node.literal
            }
          },
        },
        height: '500px',
        initialEditType: 'wysiwyg',
        initialValue: this.field.value,
        previewStyle: 'tab',
        hideModeSwitch: true,
        toolbarItems: this.field.buttons,
        events: {
          change: () => this.handleChange(this.editor.getMarkdown().replace(/(<([^>]+)>)/ig, ""))
        },
      })
    },

    methods: {
      /*
        * Set the initial, internal value for the field.
        */
      setInitialValue() {
        this.value = this.field.value || ''
      },

      /**
       * Fill the given FormData object with the field's internal value.
       */
      fill(formData) {
        formData.append(this.field.attribute, this.value || '')
      },

      /**
       * Update the field's internal value.
       */
      handleChange(value) {
        this.value = value
      },
    },
}
</script>

<style>
  .tui-editor-defaultUI-toolbar {
    border-radius: .5rem .5rem 0 0;
  }

  .te-ww-container {
    border-radius: 0 0 .5rem .5rem;
  }

  .tui-editor-defaultUI {
    border: none;
  }
</style>
