import { defineCollection } from 'astro:content';
import { glob } from 'astro/loaders';
import { z } from 'astro/zod';

const research = defineCollection({
  loader: glob({ pattern: '**/*.yaml', base: './src/content/research' }),
  schema: z.object({
    code: z.string().regex(/^[SCDEAWF]\d+$/),
    name: z.string().min(1),
    branch: z.enum(['spellcraft', 'craftsmanship', 'divine', 'economics', 'alchemy', 'warfare', 'forbidden']),
    availableTo: z.string().min(1),
    details: z.array(z.object({
      label: z.string().min(1),
      text: z.string(),
    })),
    tierTable: z.object({
      key: z.enum(['hierarchy', 'apprenticeship', 'decentralization', 'upheaval']),
      heading: z.string(),
    }).optional(),
  }),
});

const researchTree = defineCollection({
  loader: glob({ pattern: '*.yaml', base: './src/content/research-tree' }),
  schema: z.object({
    nodes: z.array(z.object({
      code: z.string().regex(/^[SCDEAWF]\d+$/),
      coords: z.string().regex(/^\d+,\d+,\d+,\d+$/),
    })),
  }),
});

const trophies = defineCollection({
  loader: glob({ pattern: '*.yaml', base: './src/content/trophies' }),
  schema: z.object({
    category: z.enum(['secret', 'allegiance', 'miscellaneous', 'magic', 'building']),
    label: z.string().min(1),
    order: z.number().int().min(0),
    trophies: z.array(z.object({
      id: z.string().regex(/^[a-z0-9-]+$/),
      name: z.string().min(1),
      icon: z.string().regex(/^[a-z0-9-]+\.png$/),
      body: z.string(),
      guide: z.object({
        href: z.string().min(1),
        label: z.string().min(1),
      }).optional(),
    })),
  }),
});

const relatedSpell = z.object({
  id: z.string().regex(/^[a-z0-9-]+$/),
  spellId: z.string().regex(/^[A-Za-z0-9]+$/),
  name: z.string().min(1),
  icon: z.string().regex(/^[a-z0-9-]+\.png$/),
  body: z.string(),
});

const spells = defineCollection({
  loader: glob({ pattern: '*.yaml', base: './src/content/spells' }),
  schema: z.object({
    spells: z.array(z.object({
      id: z.string().regex(/^[A-Za-z0-9]+$/),
      name: z.string().min(1),
      icon: z.string().regex(/^[a-z0-9-]+\.png$/),
      section: z.enum(['default', 'alignment', 'faction', 'mercenary', 'secondary-alignment', 'astral', 'special']),
      affiliation: z.string().optional(),
      body: z.string(),
      supplement: z.string().optional(),
      upgradeId: z.string().regex(/^[a-z0-9-]+$/).optional(),
      challengeId: z.string().regex(/^[a-z0-9-]+$/).optional(),
    })),
    upgrades: z.array(relatedSpell),
    challenges: z.array(relatedSpell),
  }),
});

export const collections = { research, researchTree, trophies, spells };
