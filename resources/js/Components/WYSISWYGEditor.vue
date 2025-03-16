<script setup>
import { component as CKEditor } from "@ckeditor/ckeditor5-vue";

import { ClassicEditor } from "@ckeditor/ckeditor5-editor-classic";

import { Alignment } from "@ckeditor/ckeditor5-alignment";
import { Bold, Italic, Underline } from "@ckeditor/ckeditor5-basic-styles";
import { BlockQuote } from "@ckeditor/ckeditor5-block-quote";
import { Essentials } from "@ckeditor/ckeditor5-essentials";
import { Heading } from "@ckeditor/ckeditor5-heading";
import {
  Image,
  ImageCaption,
  ImageStyle,
  AutoImage,
  ImageToolbar,
  ImageInsert,
} from "@ckeditor/ckeditor5-image";
import { Indent } from "@ckeditor/ckeditor5-indent";
import { Link } from "@ckeditor/ckeditor5-link";
import { List } from "@ckeditor/ckeditor5-list";
import { Paragraph } from "@ckeditor/ckeditor5-paragraph";
import {
  Table,
  TableToolbar,
  TableUI,
  TableCellProperties,
} from "@ckeditor/ckeditor5-table";
import { TextTransformation } from "@ckeditor/ckeditor5-typing";
import { Font } from "@ckeditor/ckeditor5-font";
import { CodeBlock } from "@ckeditor/ckeditor5-code-block";

const editor = ClassicEditor;
const editorConfig = {
  plugins: [
    Essentials,
    Bold,
    Italic,
    Alignment,
    Font,
    CodeBlock,
    Link,
    Paragraph,
    Heading,
    Underline,
    Table,
    TableToolbar,
    TableUI,
    TableCellProperties,
    BlockQuote,
    Image,
    ImageInsert,
    ImageCaption,
    ImageStyle,
    ImageToolbar,
    List,
    Indent,
    AutoImage,
    TextTransformation,
  ],
  fontSize: {
    options: [9, 11, 13, "default", 17, 19, 21],
    supportAllValues: true,
  },
  toolbar: {
    items: [
      "undo",
      "redo",
      "|",
      "heading",
      "|",
      "bold",
      "italic",
      "fontFamily",
      "fontSize",
      "fontColor",
      "fontBackgroundColor",
      "|",
      "link",
      "insertTable",
      "blockquote",
      "insertImage",
      "codeBlock",
      "|",
      "bulletedList",
      "numberedList",
      "outdent",
      "indent",
      "alignment",
      "|",
    ],
  },
  image: {
    toolbar: [
      "imageTextAlternative",
      "toggleImageCaption",
      "imageStyle:inline",
      "imageStyle:block",
      "imageStyle:side",
    ],
  },
  table: {
    contentToolbar: ["tableColumn", "tableRow", "mergeTableCells"],
  },
};

const props = defineProps({
  modelValue: {
    default: "",
  },
});

const emit = defineEmits(["update:modelValue"]);

const editorInput = (value) => {
  console.log(value);
  emit("update:modelValue", value);
};
</script>
<template>
  <CKEditor
    :editor="editor"
    :config="editorConfig"
    @input="editorInput"
    :model-value="modelValue"
  ></CKEditor>
</template>
