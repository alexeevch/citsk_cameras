<script setup lang="ts">
import { shallowRef } from "vue";
import type { YMap, DomEventHandler } from "@yandex/ymaps3-types";
import {
  YandexMap,
  YandexMapDefaultSchemeLayer,
  YandexMapDefaultFeaturesLayer,
  YandexMapListener,
  YandexMapEntity,
} from "vue-yandex-maps";

const map = shallowRef<null | YMap>(null);

const logMapClick: DomEventHandler = (object, event) =>
  console.log(object, event);

const { sidebar, open: openSidebar } = useSidebar();
</script>

<template>
  <client-only>
    <yandex-map
      v-model="map"
      :settings="{
        location: {
          center: [41.9734, 45.0428],
          zoom: 13,
        },
        theme: 'dark',
      }"
      width="100%"
      height="100%"
    >
      <yandex-map-entity>
        <div class="btn-wrapper">
          <ButtonGroup>
            <Button class="btn" severity="contrast" rounded>
              <i class="pi pi-send"></i>
            </Button>
            <Button
              v-if="!sidebar.isOpen"
              class="btn"
              severity="contrast"
              rounded
              @click="openSidebar"
            >
              <i class="pi pi-bars"></i>
            </Button>
          </ButtonGroup>
        </div>
      </yandex-map-entity>
      <yandex-map-default-scheme-layer
        :settings="{
          customization: [
            {
              tags: {
                all: ['poi'],
              },
              stylers: [
                {
                  visibility: 'off',
                },
              ],
            },
          ],
        }"
      />
      <yandex-map-default-features-layer />
      <yandex-map-listener :settings="{ onClick: logMapClick }" />
    </yandex-map>
  </client-only>
</template>

<style scoped lang="scss">
.map-wrapper {
  height: 100%;
  width: 100%;
}

.btn-wrapper {
  position: absolute;
  bottom: pxToRem(32);
  left: 50%;
  transform: translate(-50%, -50%);

  .pi {
    font-size: pxToRem(32) !important;
  }
}
</style>
