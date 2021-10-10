<template>
<div>
  <h1 v-if="forms.id == ''">listItemAdd</h1>
  <h1 v-else>listItemEdit</h1>

  <v-form
    ref="form"
    v-model="valid"
  >

    <v-text-field
      v-model="forms.textbox"
      label="テキストボックス"
      :rules="[rules.required, rules.max_16]"
      :error="errors.textbox"
      :error-messages="messages.textbox"
      @keydown="clearError('textbox')"
    ></v-text-field>

    <v-textarea
      v-model="forms.textarea"
      label="テキストエリア"
      auto-grow
      :rules="[rules.required, rules.max_100]"
      :error="errors.textarea"
      :error-messages="messages.textarea"
      @keydown="clearError('textarea')"
    ></v-textarea>

    <v-radio-group
      v-model="forms.radiobtn"
      label="ラジオボタン"
      row
      :rules="[rules.required]"
      :error="errors.radiobtn"
      :error-messages="messages.radiobtn"
      @change="clearError('radiobtn')"
    >
      <v-radio
        v-for="(name, index) in constant.RADIOS"
        :key=index
        :label=name
        :value=index
      ></v-radio>
    </v-radio-group>

    <v-select
      v-model="forms.select"
      label="セレクトボックス"
      :items="constant.SELECTS"
      item-text=name
      item-value=id
      :rules="[rules.required]"
      :error="errors.select"
      :error-messages="messages.select"
      @change="clearError('select')"
    ></v-select>

    <v-container>
      <v-row>
        <div
          :class="errors.checkbox ? `theme--light v-label error--text` : `theme--light v-label`"
          style="margin-bottom: 0.5rem;"
        >チェックボックス</div>
      </v-row>
      <v-row>
        <v-checkbox
          v-model="forms.checkbox"
          v-for="(name, index) in constant.CHECKS"
          :key=index
          :label=name
          :value=index
          style="margin: 0 16px 0 0;"
          :rules="[rules.check_least_1]"
          :error="errors.checkbox"
          hide-details
          @change="changeCheckbox"
        ></v-checkbox>
      </v-row>
      <div
        v-for="(message, index) in messages.checkbox"
        :key=index
        class="v-messages error--text row"
      >{{ message }}</div>
    </v-container>

    <v-btn
      :disabled="!valid"
      color="success"
      @click="submit"
    >
      送信
    </v-btn>

    <v-btn
      @click="radioClear"
    >
      ラジオボタンクリア
    </v-btn>

  </v-form>

</div>
</template>

<script>
  export default {
    data() {
      return {
        valid: true,			// ①
        constant: {				// ②
          RADIOS: {},
          SELECTS: [],
          CHECKS: {},
        },
        forms: {				// ③
          id: '',
          textbox: '',
          textarea: '',
          radiobtn: '1',
          select: '',
          checkbox: [],
        },
        rules: {
          required: value => !!value || '必須です。',
          max_16: value => value.length <= 16 || '16文字以内です。',
          max_100: value => value.length <= 100 || '100文字以内です。',
          check_least_1: value => {
            return value.length > 0 || '1つは必須選択です。'
          }
        },
        errors: {
          textbox: false,	// 追加
          textarea: false,	// 追加
          radiobtn: false,	// 追加
          select: false,	// 追加
          checkbox: false,
        },
        messages: {
          textbox: null,	// 追加
          textarea: null,	// 追加
          radiobtn: null,	// 追加
          select: null,		// 追加
          checkbox: null,
        }
      }
    },
    created() {					// ⑤
      axios.get('/const').then((res) => {
        let constData = res.data.const;
        this.constant.RADIOS = constData.RADIOS;
        this.constant.SELECTS = Object.entries(constData.SELECTS).map(([key, name]) => ({'id': key, 'name': name}))
        this.constant.CHECKS = constData.CHECKS;
      })
      .catch(function(error) {
        console.log(error)
        // エラー処理
      })

     // 以下追加
      if (this.$route.params.id) {
        this.forms.id = this.$route.params.id;
        axios.get('/ajax/list/item/' + this.$route.params.id).then((res) => {
          if (res.data.status == 200) {
            const item = res.data.item;
            item.radiobtn = item.radiobtn.toString()
            item.select = item.select.toString()
            this.forms = item;
          } else {
            // エラー処理
          }
        })
        .catch(function(error) {
          console.log(error)
          // エラー処理
        })
      }

    },
    methods: {
      // 送信ボタンを押したとき
      submit() {
        // 全てのエラーをリセット
        Object.keys(this.errors).forEach((key) => {
          this.errors[key] = false;
          this.messages[key] = null;
        })
        let ajax;
        if (this.forms.id) {
          // 更新
          ajax = axios.put('/ajax/list/item/' + this.forms.id, this.forms);
        } else {
          // 新規登録
          ajax = axios.post('/ajax/list/item', this.forms);
        }
        ajax.then((res) => {
          let response = res.data;
          if (response.status == 400) {
            // バリデーションエラー
            Object.keys(response.errors).forEach((key) => {
              this.errors[key] = true;
              this.messages[key] = response.errors[key];
            })
          } else {
            // 成功したらlistItemコンポーネントを表示
            this.$router.push('/list/item');
          }
        })
        .catch((error) => {
          console.log(error.response)
        })
      },
      // 各エラーのリセット
      clearError(item) {
        this.errors[item] = false;
        this.messages[item] = null;
      },
      changeCheckbox() {		// ⑥
        this.errors.checkbox = false;
        this.messages.checkbox = '';
        if (this.forms.checkbox.length == 0) {
          this.errors.checkbox = true;
          this.messages.checkbox = '1つは必須選択です。';
        }
      },
      radioClear() {			// ⑦
        this.forms.radiobtn = '';
      }
    },
  }
</script>
