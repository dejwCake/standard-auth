<?php
namespace DejwCake\StandardAuth\Model\Entity\Helper;

/**
 * Contains a translation method aimed to help managing multiple translations
 * for an entity.
 */
trait EnableTrait
{

    public function enable() {
        if(!empty($this->id) && $this->exists()) {
            $this->read();

            if(!is_null($this->get('enabled')))
            {
                if ($this->get('enabled') == 0)
                    $disabled = '1';
                else
                    $disabled = '0';
                return $this->saveField('disabled', $disabled);
            }
            return false;
        }
        return false;
    }

    /**
     * Returns the entity containing the translated fields for this object and for
     * the specified language. If the translation for the passed language is not
     * present, a new empty entity will be created so that values can be added to
     * it.
     *
     * @param string $language Language to return entity for.
     * @return $this|\Cake\ORM\Entity
     */
    public function translation($language)
    {
        if ($language === $this->get('_locale')) {
            return $this;
        }

        $i18n = $this->get('_translations');
        $created = false;

        if (empty($i18n)) {
            $i18n = [];
            $created = true;
        }

        if ($created || empty($i18n[$language]) || !($i18n[$language] instanceof EntityInterface)) {
            $className = get_class($this);

            $i18n[$language] = new $className();
            $created = true;
        }

        if ($created) {
            $this->set('_translations', $i18n);
        }

        // Assume the user will modify any of the internal translations, helps with saving
        $this->dirty('_translations', true);

        return $i18n[$language];
    }
}
