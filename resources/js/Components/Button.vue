<script setup lang="ts">
import { computed } from 'vue';
import { ButtonColors } from '@/enums/ButtonColors';

export interface Props {
  cor: ButtonColors,
}

const props = withDefaults(defineProps<Props>(), {
  cor: ButtonColors.blue,
})

const colorClasses = computed(()=>{
    switch (props.cor) {
        case ButtonColors.blue:
            return ["bg-blue-500", "hover:bg-blue-700"]
    
        default:
            return ["bg-red-500", "hover:bg-red-700"]
    }
});

</script>

<template>
    <button 
        @click="$emit('meu-click')"
        class="text-white font-bold py-2 px-4 rounded ml-2 mr-2"
        :class="colorClasses">
        <slot />
    </button>
</template>
